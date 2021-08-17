<?php
namespace Kubex\Definitions;

class Path
{
  public $id;
  public $path;
  public $method;

  public $name;
  public $description;

  public $requestPermissions = [];//[]Permission
  public $requiredPermissions = [];//[]Permission

  public $appNavigationSections = [];//[]NavigationSection
  public $appNavigation = [];//[]Navigation
  public $pageNavigation = [];//[]Navigation
  public $pageActions = [];//[]Navigation
}
