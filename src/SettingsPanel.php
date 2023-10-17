<?php

namespace Kubex\Definitions;

class SettingsPanel
{
  public string $name;
  public string $description;
  /** @var Property[] */
  public array $settings = [];
  public int $order;
}
