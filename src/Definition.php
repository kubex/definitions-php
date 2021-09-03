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
  /** @var array<Navigation> */
  public array $unify = [];
}
