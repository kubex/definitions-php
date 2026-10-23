<?php
namespace Kubex\Definitions;

class Headers
{
  // RequestWorkspaceID Workspace UUID
  const RequestWorkspaceID = "x-kx-workspace-id";

  // RequestUserID User UID
  const RequestUserID = "x-kx-user-id";

  // RequestSignature Kubex Signature
  const RequestSignature = "x-kx-signature";

  // RequestTraceID Kubex request Trace ID
  const RequestTraceID = "x-kx-trace-id";

  // RequestUserIP User IP
  const RequestUserIP = "x-kx-user-ip";

  // RequestUserAgent User Agent
  const RequestUserAgent = "x-kx-user-agent";

  // RequestAuthorization Json Authorizations, [{"k":"permission-key","e":"A","r":"*"},"k":"permission-key-2","e":"D","r":"uid1"]
  const RequestAuthorization = "x-kx-authorization";

  // RequestAuthentication JSON access credentials, provided by the app e.g. {"accessToken":"xx"}
  const RequestAuthentication = "x-kx-authentication";

  // RequestWorkspaceHost The full workspace host the user is currently in
  const RequestWorkspaceHost = "x-kx-workspace-host"; // Host of the workspace, used for routing

  // RequestBrands CSV of permitted brands
  const RequestBrands = "x-kx-brands";

  // RequestDepartments CSV of permitted departments
  const RequestDepartments = "x-kx-departments";

  // RequestChannels CSV of permitted channels
  const RequestChannels = "x-kx-channels";

  const RequestDistributors = "x-kx-distributors";
  const RequestPreferredLabels = "x-kx-preferred-labels";
  const RequestConnectionID = "x-kx-connection-id";
  const RequestConnectionToken = "x-kx-connection-token";

  // RequestConfiguration JSON configuration data for the app k:v pairs
  const RequestConfiguration = "x-kx-configuration";

  // RequestCallerApp identifies the calling app in an RPC request
  const RequestCallerApp = "x-kx-caller-app";

  const RequestEditorID = "x-kx-editor-id";
  const RequestFetchStyle = "x-kx-fetch-style";
  const RequestContextData = "x-kx-context-data";
  const RequestActiveTab = "x-kx-active-tab";

  // ResponseDebug Debug object for the browser
  const ResponseDebug = "x-kubex-debug";

  // ResponseAlert alert text
  const ResponseAlert = "x-kubex-alert";

  // ResponseAlertInfo alert text
  const ResponseAlertInfo = "x-kubex-alert-info";

  // ResponseAlertSuccess alert text
  const ResponseAlertSuccess = "x-kubex-alert-success";

  // ResponseAlertWarning alert text
  const ResponseAlertWarning = "x-kubex-alert-warning";

  // ResponseAlertDanger alert text
  const ResponseAlertDanger = "x-kubex-alert-danger";

  // ResponseAppendElement append element to the DOM
  const ResponseAppendElement = "x-kubex-append-element";

  // ResponseVanishElement vanish element from the DOM
  const ResponseVanishElement = "x-kubex-vanish-element";

  // ResponseCloseModal close modal
  const ResponseCloseModal = "x-kubex-close-modal";

  // ResponseBasisPx ideal viewport in pixels (not guaranteed)
  const ResponseBasisPx = "x-kubex-basis-px";

  // ResponseRemoveSelf remove self from the DOM
  const ResponseRemoveSelf = "x-kubex-remove-self";

  // ResponseRefresh refresh (self, referer or space-ID[#fragment])
  const ResponseRefresh = "x-kubex-refresh";

  // Reload table rows, preserving search, filters and pagination (self or CSS selectors).
  const ResponseRefreshDataTable = "x-kubex-refresh-data-table";

  public static function createSignatureKey(string $workspaceID, string $appSecret): string
  {
    return hash('sha256', $workspaceID . "\0" . $appSecret);
  }

  // ResponseForwardUri forward the browser to a new URI
  const ResponseForwardUri = "x-kubex-forward-uri";

  // ResponseForwardGaid sets the gaid for the forward URI
  const ResponseForwardGaid = "x-kubex-forward-gaid"; // GAID of the forward URI

  // ResponseCount item count
  const ResponseCount = "x-kubex-count";

  // ResponseColor item color
  const ResponseColor = "x-kubex-color";

  // ResponseClearValue clear the value of an input field
  const ResponseClearValue = "x-kubex-clear-value";

  public static function verify(array $headers, $signatureKey, $maxTimeDiff = 60): bool
  {
    $parts = explode('/', static::value($headers, static::RequestSignature, '/'), 2);
    if(count($parts) !== 2)
    {
      return false;
    }
    [$signature, $timestamp] = $parts;
    if(!preg_match('/^[0-9]+$/D', $timestamp) || !preg_match('/^[a-f0-9]{64}$/D', $signature))
    {
      return false;
    }
    $time = time();
    if($timestamp > ($time + $maxTimeDiff) || $timestamp < ($time - $maxTimeDiff))
    {
      return false;
    }

    return hash_equals(hash(
        'sha256',
        static::value($headers, static::RequestWorkspaceID)
        . static::value($headers, static::RequestUserID)
        . $signatureKey
        . static::value($headers, static::RequestTraceID)
        . static::value($headers, static::RequestUserIP)
        . static::value($headers, static::RequestUserAgent)
        . $timestamp
      ), $signature);
  }

  public static function value(array $headers, $key, $default = '')
  {
    $headers = array_change_key_case($headers, CASE_LOWER);
    $value = $headers[strtolower($key)] ?? $default;
    return is_array($value) ? implode('', $value) : $value;
  }

  /**
   * @param $headers
   *
   * @return PermissionPolicy
   */
  public static function readAuthorization($headers): PermissionPolicy
  {
    $policy = new PermissionPolicy();
    $auth = static::value($headers, static::RequestAuthorization);
    $decoded = $auth ? json_decode($auth, true) : null;
    if(empty($decoded))
    {
      return $policy;
    }

    foreach($decoded as $raw)
    {
      //[{"e":"Allow","p":{"vendorID":"vendor","appID":"app","Key":"view"},"r":""}]
      $statement = new PermissionStatement();
      $statement->effect = in_array(($raw['e'] ?? ''), ['A', 'Allow'])
        ? PermissionEffect::Allow : PermissionEffect::Deny;
      $statement->resource = $raw['r'] ?? '';
      $statement->meta = $raw['m'] ?? [];
      $statement->permission = ScopedKey::create(
        $raw['p']['vendorID'] ?? '',
        $raw['p']['appID'] ?? '',
        $raw['p']['Key'] ?? $raw['p']['key'] ?? '',
      );
      $policy->statements[] = $statement;
    }

    return $policy;
  }
}
