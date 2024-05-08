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
  public bool $promptOnExit = false;

  /** @var array<ScopedKey> */
  public array $requestPermissions = [];
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];

  /** @var array<EntryPoint> */
  public array $navigation = [];
  /** @var array<EntryPoint> */
  public array $actions = [];
}
