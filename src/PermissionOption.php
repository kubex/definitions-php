<?php
namespace Kubex\Definitions;

class PermissionOption
{
  /** @var array<string, string> */
  public array $availableValues;
  /** @var string|PropertyType */
  public string $type;
  /** @var string|PropertyDisplayType */
  public string $displayType;
}
