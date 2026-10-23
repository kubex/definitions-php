<?php
namespace Kubex\Definitions;

class RequestContext
{
  public string $workspaceID = '';
  public string $userID = '';
  public string $traceID = '';
  public string $userIP = '';
  public string $userAgent = '';
  /** @var PermissionStatement[] */
  public array $authorization = [];
  public mixed $authentication = null;
  public ?GlobalAppID $ownAppID;
  private array $headers = [];

  public function __construct(array $headers = [], ?GlobalAppID $ownAppID = null)
  {
    $this->ownAppID = $ownAppID;
    $this->applyHeaders($headers);
  }

  public function applyHeaders(array $headers): void
  {
    $this->headers = array_replace($this->headers, array_change_key_case($headers, CASE_LOWER));
    $this->workspaceID = Headers::value($this->headers, Headers::RequestWorkspaceID);
    $this->userID = Headers::value($this->headers, Headers::RequestUserID);
    $this->traceID = Headers::value($this->headers, Headers::RequestTraceID);
    $this->userIP = Headers::value($this->headers, Headers::RequestUserIP);
    $this->userAgent = Headers::value($this->headers, Headers::RequestUserAgent);
    $this->authorization = Headers::readAuthorization($this->headers)->statements;
    $this->authentication = json_decode(Headers::value($this->headers, Headers::RequestAuthentication));
  }

  public function verify(string $signatureKey, int $maxTimeDiff = 60): bool
  {
    return Headers::verify($this->headers, $signatureKey, $maxTimeDiff);
  }

  private function matchesPermission(ScopedKey $permission, ScopedKey $against): bool
  {
    $vendor = $permission->vendorID ?? '';
    $app = $permission->appID ?? '';
    if($vendor === '' && $app === '' && $this->ownAppID !== null)
    {
      $vendor = $this->ownAppID->vendorID;
      $app = $this->ownAppID->appID;
    }
    return $vendor === ($against->vendorID ?? '')
      && $app === ($against->appID ?? '')
      && $permission->key === $against->key;
  }

  public function hasPermission(ScopedKey $permission): bool
  {
    return $this->checkPermission($permission, null);
  }

  public function hasResourcePermission(ScopedKey $permission, string $resource): bool
  {
    return $this->checkPermission($permission, $resource);
  }

  private function checkPermission(ScopedKey $permission, ?string $resource): bool
  {
    $allowed = false;
    foreach($this->authorization as $statement)
    {
      if(!$this->matchesPermission($permission, $statement->permission))
      {
        continue;
      }
      if($resource !== null && $statement->resource !== $resource
        && !(str_ends_with($statement->resource, '*')
          && str_starts_with($resource, substr($statement->resource, 0, -1))))
      {
        continue;
      }
      if($statement->effect === PermissionEffect::Deny)
      {
        return false;
      }
      if($statement->effect === PermissionEffect::Allow)
      {
        $allowed = true;
      }
    }
    return $allowed;
  }

  public function permittedResources(ScopedKey $permission): array
  {
    return $this->resourcesWithEffect($permission, PermissionEffect::Allow);
  }

  public function deniedResources(ScopedKey $permission): array
  {
    return $this->resourcesWithEffect($permission, PermissionEffect::Deny);
  }

  private function resourcesWithEffect(ScopedKey $permission, string $effect): array
  {
    $resources = [];
    foreach($this->authorization as $statement)
    {
      if($this->matchesPermission($permission, $statement->permission) && $statement->effect === $effect)
      {
        $resources[] = $statement->resource;
      }
    }
    return $resources;
  }

  public function brands(): array { return Resource::fromHeader(Headers::value($this->headers, Headers::RequestBrands)); }
  public function departments(): array { return Resource::fromHeader(Headers::value($this->headers, Headers::RequestDepartments)); }
  public function channels(): array { return Resource::fromHeader(Headers::value($this->headers, Headers::RequestChannels)); }
  public function distributors(): array { return Resource::fromHeader(Headers::value($this->headers, Headers::RequestDistributors)); }
}
