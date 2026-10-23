<?php
namespace Kubex\Definitions;

class ProviderDependency
{
  public string $type;
  public bool $required = false;
  public string $reason = '';
  /** @var string[] */
  public array $requiredActions = [];
}
