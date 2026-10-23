<?php
namespace Kubex\Definitions;

class BlueprintIntegration
{
  public string $sourceVendor;
  public string $sourceApp;
  public string $targetVendor;
  public string $targetApp;
  /** @var string[] */
  public array $operations = [];
}
