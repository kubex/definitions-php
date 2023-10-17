<?php

namespace Kubex\Definitions;

class SettingsPage
{
  public string $id;
  public string $name;
  /** @var SettingsPanel[] */
  public array $settingsPanel = [];
  public string $advancedPath;
}
