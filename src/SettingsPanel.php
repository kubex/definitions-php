<?php

namespace Kubex\Definitions;

class SettingsPanel
{
  public Text $name;
  public Text $description;
  /** @var Property[] */
  public array $settings = [];
  public int $order;
}
