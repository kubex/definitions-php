<?php
namespace Kubex\Definitions;

class Headers
{
  const WorkspaceID = "x-kx-workspace-id";// Workspace UUID
  const UserID = "x-kx-user-id";// User UID
  const Signature = "x-kx-signature";// Kubex Signature
  const TraceID = "x-kx-trace-id";// Kubex request Trace ID

  const UserIP = "x-kx-user-ip";// User IP
  const UserAgent = "x-kx-user-agent";// User Agent

  const Authorization = "x-kx-authorization";// Json Authorizations, [{"k":"permission-key","e":"A","r":"*"},"k":"permission-key-2","e":"D","r":"uid1"]
  const Authentication = "x-kx-authentication";// JSON access credentials, provided by the app e.g. {"accessToken":"xx"}

  public static function verify(array $headers, $signatureKey, $maxTimeDiff = 60): bool
  {

    function headerValue($headers, $key, $default = '')
    {
      $value = $headers[$key] ?? $default;
      return is_array($value) ? implode('', $value) : $value;
    }

    [$signature, $timestamp] = explode('/', headerValue($headers, static::Signature, '/'), 2);
    $time = time();
    if($timestamp > ($time + $maxTimeDiff) || $timestamp < ($time - $maxTimeDiff))
    {
      return false;
    }

    return $signature == hash(
        'sha256',
        headerValue($headers, static::WorkspaceID)
        . headerValue($headers, static::UserID)
        . $signatureKey
        . headerValue($headers, static::TraceID)
        . headerValue($headers, static::UserIP)
        . headerValue($headers, static::UserAgent)
        . $timestamp
      );
  }
}
