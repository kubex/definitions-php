<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  public ScopedKey $integrateApp; // Which app to integrate into
  /** @var string|IntegrationLocation */
  public string $location; // Where to place the integration
  public string $locationID; // Location ID if multiple locations available
  public string $pathID; //Remote app path ID
  public EntryPoint $entryPoint; // How the integration is presented
  public bool $multiPanel; // Whether the integration can be shows multiple panels

  public int $preferredWidth; // Preferred width of the integration

  /** @var array<EntryPoint> */
  public array $panelActions = [];  // Actions to add to the panel
  /** @var array<EntryPoint> */
  public array $panelTabs = [];  // Tabs to show - panels only

  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];// Permissions that must be set for the user to see this item
}
