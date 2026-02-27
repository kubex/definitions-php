<?php
namespace Kubex\Definitions;

trait AccessRequest
{
  /** @var array<ScopedKey> */
  public array $requestPermissions = []; // Permissions that should be sent to this path
  /** @var array<ScopedKey> */
  public array $requiredPermissions = []; // Permissions that must be set for the user to call this page

  /** @var array<BuiltInResource> */
  public array $builtInResources = [];

  /** @var array<ScopedKey> */
  public array $requestConfig = []; // Configuration values that should be sent to this path
}
