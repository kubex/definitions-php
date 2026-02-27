<?php
namespace Kubex\Definitions;

// Dependency declares a dependency on another app's Operation endpoints.
class Dependency
{
  public GlobalAppID $app;
  /** @var array<string> */
  public array $requiredOperations = [];
  /** @var array<string> */
  public array $requestedOperations = [];
  public bool $required = false;
  public string $reason;
}
