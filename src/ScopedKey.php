<?php
namespace Kubex\Definitions;

class ScopedKey
{
  public GlobalAppID $app;
  public string $key;

  public static function create($key)
  {
    $pk = new static();
    $pk->key = $key;
    return $pk;
  }
}
