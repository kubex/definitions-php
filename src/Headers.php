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
    [$signature, $timestamp] = explode('/', static::value($headers, static::RequestSignature, '/'), 2);
    $time = time();
    if($timestamp > ($time + $maxTimeDiff) || $timestamp < ($time - $maxTimeDiff))
    {
      return false;
    }

    return $signature == hash(
        'sha256',
        static::value($headers, static::RequestWorkspaceID)
        . static::value($headers, static::RequestUserID)
        . $signatureKey
        . static::value($headers, static::RequestTraceID)
        . static::value($headers, static::RequestUserIP)
        . static::value($headers, static::RequestUserAgent)
        . $timestamp
      );
  }

  public static function value(array $headers, $key, $default = '')
  {
    $value = $headers[$key] ?? $default;
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
        $raw['p']['Key'] ?? '',
      );
      $policy->statements[] = $statement;
    }

    return $policy;
  }
}
