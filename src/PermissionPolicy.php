<?php
namespace Kubex\Definitions;

class PermissionPolicy
{
  public string $uuid;
  public string $key;
  public Text $name;
  public Text $description;
  /**
   * @var array<PermissionStatement>
   */
  public array $statements = [];
}
