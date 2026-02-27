<?php
namespace Kubex\Definitions;

// Operation describes a callable API endpoint for app-to-app communication.
class Operation
{
  use AccessRequest;

  public string $key;
  public string $description;

  public string $path;
  public string $method;

  /** @var array<Property> */
  public array $inputs = [];
  /** @var array<Property> */
  public array $outputs = [];

  public bool $userContextRequired = false;
}
