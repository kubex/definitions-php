<?php
namespace Kubex\Definitions;

class PermissionStatement implements \JsonSerializable
{
  public string $effect;
  public ScopedKey $permission;
  public string $resource;

  /**
   * @var array<string,string>
   */
  public array $meta = [];

  public function jsonSerialize()
  {
    return [
      'e' => $this->effect,
      'p' => $this->permission,
      'r' => $this->resource,
      'm' => $this->meta,
    ];
  }

}
