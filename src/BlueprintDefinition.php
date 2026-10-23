<?php
namespace Kubex\Definitions;

class BlueprintDefinition
{
  public string $id;
  public string $name;
  public string $description;
  public string $icon;
  public string $version; // Semantic version
  /** @var BlueprintApp[] */
  public array $apps = [];
  /** @var BlueprintRole[] */
  public array $roles = [];
  /** @var BlueprintIntegration[] */
  public array $integrations = [];
}
