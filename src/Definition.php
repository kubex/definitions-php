<?php
namespace Kubex\Definitions;

class Definition
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

  /** @var array<\Kubex\Definitions\PermissionPolicy> */
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

  public string $hash; // Hash of the definition for change detection, latest hash can be returned in HealthResponse
}
