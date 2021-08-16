<?php
namespace Kubex\Definitions;

class Path
{
  public string $id;
  public string $path;
  public string $method;

  public Text $name;
  public Text $description;

  public array $requestPermissions = [];//[]Permission
  public array $requiredPermissions = [];//[]Permission

  public array $appNavigationSections = [];//[]NavigationSection
  public array $appNavigation = [];//[]Navigation
  public array $pageNavigation = [];//[]Navigation
  public array $pageActions = [];//[]Navigation
}
