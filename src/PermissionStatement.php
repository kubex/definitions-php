<?php
namespace Kubex\Definitions;

class PermissionStatement
{
  public string $effect;
  public ScopedKey $permission;
  public string $resource;

  /**
   * @var array<string,string>
   */
  public array $meta = [];
}
