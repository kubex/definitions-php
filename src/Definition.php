<?php
namespace Kubex\Definitions;

class Definition implements \JsonSerializable
{
  public GlobalAppID $id;
  public string $endpoint;
  public string $defaultPath; // Default path to use when opening the app

  public Text $name;
  public Text $description;

  /** @var string|UIMode */
  public string $UIMode;
  /** @var string|Category */
  public string $category;
  public string $icon = 'pending';//material design icon

  /** @var array<GlobalAppID> */
  public array $dependencies = [];

  /** @var array<Permission> */
  public array $permissions = [];

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

  public string $configurationPath;

  public string $homepage;

  public string $termsOfService;

  public string $privacyPolicy;

  public string $supportEmail;

  public array $permittedProxyPaths = []; // Paths that can be proxied by the platform, without auth / modification

  public string $searchPanelPath; // Path to post search queries to

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

  public string $hash = ''; // Hash of the definition for change detection, latest hash can be returned in HealthResponse

  #[\ReturnTypeWillChange]
  public function jsonSerialize()
  {
    $data = get_object_vars($this);
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
    $hash = md5(json_encode(get_object_vars($this)));
    $this->hash = $original == '' && $updateIfEmpty ? $hash : $original;
    return $this->hash ?: $hash;
  }
}
