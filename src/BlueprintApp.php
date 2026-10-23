<?php
namespace Kubex\Definitions;

class BlueprintApp implements \JsonSerializable
{
  public string $vendorID;
  public string $appID;
  public string $releaseChannel;
  public bool $required = false;
  /** @var array<string, string> */
  public array $settings;

  public function jsonSerialize(): mixed
  {
    $data = get_object_vars($this);
    if(isset($this->settings))
    {
      $data['settings'] = (object)$this->settings;
    }
    return $data;
  }
}
