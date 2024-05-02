<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  public GlobalAppID $integrateApp; // Which app to integrate into
  /** @var string|IntegrationLocation */
  public string $location; // Where to place the integration
  public string $locationID; // Location ID if multiple locations available
  public string $pathID; //Remote app path ID
  public EntryPoint $entryPoint; // How the integration is presented
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];// Permissions that must be set for the user to see this item
}
