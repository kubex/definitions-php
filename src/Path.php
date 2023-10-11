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

  /** @var array<Navigation> */
  public array $navigation = [];
  /** @var array<Navigation> */
  public array $actions = [];
}
