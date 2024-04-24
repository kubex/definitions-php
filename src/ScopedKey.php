<?php
namespace Kubex\Definitions;

class ScopedKey extends GlobalAppID
{
  public string $key;

  public static function create($vendor, $app, $key = null)
  {
    $pk = static::create($vendor, $app);
    $pk->key = $key;
    return $pk;
  }

  public static function createKey(string $key)
  {
    $pk = new static();
    $pk->key = $key;
    return $pk;
  }
}
