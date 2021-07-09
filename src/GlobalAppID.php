<?php
namespace Kubex\Definitions;

class GlobalAppID
{
  public string $vendorID;
  public string $appID;

  public static function create($vendor, $app)
  {
    $gaid = new static();
    $gaid->vendorID = $vendor;
    $gaid->appID = $app;
    return $gaid;
  }
}
