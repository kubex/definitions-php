<?php
namespace Kubex\Definitions;

class PermissionStatement
{
  public string $effect;
  public PermissionKey $permission;
  public string $resource;
}
