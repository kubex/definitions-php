<?php
namespace Kubex\Definitions;

class Path
{
  public string $id;
  public string $path;
  public string $method;

  public Text $name;
  public Text $description;

  /** @var array<PermissionKey> */
  public array $requestPermissions = [];
  /** @var array<PermissionKey> */
  public array $requiredPermissions = [];

  /** @var array<NavigationSection> */
  public array $appNavigationSections = [];
  /** @var array<Navigation> */
  public array $appNavigation = [];
  /** @var array<Navigation> */
  public array $pageNavigation = [];
  /** @var array<Navigation> */
  public array $pageActions = [];
}
