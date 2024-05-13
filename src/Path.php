<?php
namespace Kubex\Definitions;

class Path
{
  public string $id; // Allow the path to be linked
  public string $path; // with replacements, matches start, locating the most specific
  public string $method; // HTTP Method, blank for any

  public Text $name;
  public Text $description;

  public bool $hideHeader = false; // Hide the header when this path is active
  public bool $hideBreadcrumb = false; // Hide the breadcrumb when this path is active
  public bool $promptOnExit = false; // Prompt the user when they try to leave the page
  public bool $hoverCard = false; // If this path can be displayed as a hoverCard

  /** @var array<ScopedKey> */
  public array $requestPermissions = [];
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];

  /** @var array<EntryPoint> */
  public array $navigation = [];
  /** @var array<EntryPoint> */
  public array $actions = [];
}
