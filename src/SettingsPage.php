<?php

namespace Kubex\Definitions;

class SettingsPage
{
  public string $id;
  public Text $name;
  /** @var SettingsPanel[] */
  public array $panels = [];
  public string $advancedPath;
}
