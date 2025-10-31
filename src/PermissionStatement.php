<?php
namespace Kubex\Definitions;

class PermissionStatement implements \JsonSerializable
{
  public string $effect;
  public ScopedKey $permission;
  public string $resource;
  /** @var array<string, array<string> */
  public array $meta = [];

  #[\ReturnTypeWillChange]
  public function jsonSerialize()
  {
    return [
      'e' => $this->effect ?? PermissionEffect::Allow,
      'p' => $this->permission ?? null,
      'r' => $this->resource ?? '',
      'm' => $this->meta ?? null,
    ];
  }
}
