<?php
namespace Kubex\Definitions;

class Definition implements \JsonSerializable
{
  public const VendorAppID = "kx"; // setting your application ID to this value should be done for vendor shared

  public GlobalAppID $id;
  public string $endpoint;
  public string $mcpEndpoint;
  public string $apiEndpoint;
  public string $defaultPath; // Default path to use when opening the app

  public Text $name;
  public Text $description;

  /** @var string|UIMode */
  public string $UIMode;
  /** @var string|Category */
  public string $category;
  public string $icon = 'pending';//material design icon
  public bool $skipCSRFValidation = false;

  /** @var array<Permission> */
  public array $permissions = [];

  /** @var array<MCPCapability> */
  public array $mcpCapabilities = [];
  /** @var array<Operation> */
  public array $operations = [];
  /** @var array<Dependency> */
  public array $dependencies = [];

  /** @var ProviderRegistration[] */
  public array $providers = [];
  /** @var ProviderDependency[] */
  public array $providerDependencies = [];

  /** @var array<PermissionPolicy> */
  public array $roles = [];

  /** @var array<Path> */
  public array $paths = [];

  /** @var array<IntegrationPoint> */
  public array $unify = [];

  /** @var array<ActivationStep> */
  public array $activationSteps = [];

  /** @var array<ScopedKey> */
  public array $listenToEvents = [];

  /** @var SettingsPage[] */
  public array $configuration = [];

  /** @var EntryPoint[] configuration nav items are locked to the bottom of the app nav */
  public array $configurationNav = [];

  public string $configurationPath;

  public string $homepage;

  public string $termsOfService;

  public string $privacyPolicy;

  public string $supportEmail;

  public array $permittedProxyPaths = []; // Paths that can be proxied by the platform, without auth / modification

  /** @deprecated Use $searchPanel instead. Serialized as an EntryPoint when set. */
  public string $searchPanelPath; // Path to post search queries to
  public EntryPoint $searchPanel;

  /** @var EntryPoint[] */
  public array $searchResults = []; // To surface pages in the global search results, e.g. Linking to sub pages

  /** @var array<string, string> */
  public array $prefixRedirect; // Matching prefixes to redirect  e.g. [CST:CST => 'view/$1'] $1 includes the prefix
  /** @var array<string, string> */
  public array $quickCodes; // Matching Codes to redirect  e.g. [CST => 'view/$1'] $1 is replaced by everything after the code
  /** @var SearchPattern[] */
  public array $searchPatterns; // Quick actions made available in the outer shell

  /** @var EntryPoint[] */
  public array $quickActions; // Quick actions made available in the outer shell

  /** @var Navigation[] */
  public array $navigation = [];

  public string $navigationUri = '';

  public bool $systemApp = false; // Only system users can see/access this app
  /** @var string[] Specific user IDs with access; empty means unrestricted */
  public array $allowedUsers = [];
  public bool $provideBlueprints = false;
  public bool $provideHelp = false;
  /** @var int|Necessity */
  public int $javascriptExecution = Necessity::None;

  public string $hash = ''; // Hash of the definition for change detection, latest hash can be returned in HealthResponse

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): mixed
  {
    $data = $this->serializationData();
    if(empty($data['hash']))
    {
      $data['hash'] = $this->getHash(false);
    }
    return $data;
  }

  public function getHash(bool $updateIfEmpty = true): string
  {
    $original = $this->hash;
    $this->hash = '';
    $hash = md5(json_encode($this->serializationData()));
    $this->hash = $original == '' && $updateIfEmpty ? $hash : $original;
    return $this->hash ?: $hash;
  }

  private function serializationData(): array
  {
    $data = get_object_vars($this);
    if(!isset($this->searchPanel) && isset($this->searchPanelPath))
    {
      $panel = new EntryPoint();
      $panel->destinationPath = $this->searchPanelPath;
      $data['searchPanel'] = $panel;
    }
    // Keep the legacy field for consumers that still read it.
    return $data;
  }
}
