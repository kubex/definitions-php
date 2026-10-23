<?php
namespace Kubex\Definitions;

class ProviderRegistration
{
  public string $type;
  public string $key;
  /** @var string[] */
  public array $labels = [];
  /** @var string[] */
  public array $actions = [];
}
