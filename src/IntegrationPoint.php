<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  public GlobalAppID $integrateApp;
  /** @var string|IntegrationLocation */
  public string $location;
  public string $pathID;
  public EntryPoint $navigation;
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];
}
