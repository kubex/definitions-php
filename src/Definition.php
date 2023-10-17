<?php
namespace Kubex\Definitions;

class Definition
{
  public GlobalAppID $id;
  public string $endpoint;

  public Text $name;
  public Text $description;

  public string $UIMode;
  public string $category;
  public string $icon = 'pending';//material design icon

  /** @var array<GlobalAppID> */
  public array $dependencies = [];

  /** @var array<Permission> */
  public array $permissions = [];

  /** @var array<Path> */
  public array $paths = [];

  /** @var array<IntegrationPoint> */
  public array $unify = [];

  /** @var array<ActivationStep> */
  public array $activationSteps = [];

  /** @var SettingsPage[] */
  public array $configuration = [];

  public string $configurationPath;

  public string $homepage;

  public string $termsOfService;

  public string $privacyPolicy;

  public string $supportEmail;
}
