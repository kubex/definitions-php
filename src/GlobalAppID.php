<?php
namespace Kubex\Definitions;

class GlobalAppID
{
  public $vendorID;
  public $appID;

  public static function create($vendor, $app)
  {
    $gaid = new static();
    $gaid->vendorID = $vendor;
    $gaid->appID = $app;
    return $gaid;
  }
}
