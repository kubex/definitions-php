<?php
namespace Kubex\Definitions;

class ScopedKey
{
  public GlobalAppID $app;
  public string $key;

  public static function create(string $key, string $vendor = null, string $app = null)
  {
    $pk = new static();
    $pk->key = $key;
    if($vendor != null || $app != null)
    {
      $pk->app = GlobalAppID::create($vendor, $app);
    }
    return $pk;
  }
}
