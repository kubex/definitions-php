<?php
namespace Kubex\Definitions;

class PermissionKey
{
  public GlobalAppID $app;
  public string $key;

  public function create($key)
  {
    $pk = new static();
    $pk->key = $key;
    return $pk;
  }
}
