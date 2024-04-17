<?php
namespace Kubex\Definitions;

class Path
{
  public string $id;
  public string $path;
  public string $method;

  public Text $name;
  public Text $description;
  public bool $hideHeader = false;
  public bool $hideBreadcrumb = false;

  /** @var array<ScopedKey> */
  public array $requestPermissions = [];
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];

  /** @var array<Navigation> */
  public array $navigation = [];
  /** @var array<Navigation> */
  public array $actions = [];
}
