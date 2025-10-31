<?php
namespace Kubex\Definitions;

class PermissionStatement implements \JsonSerializable
{
  public string $effect;
  public ScopedKey $permission;
  public string $resource;
  /** @var array<string> */
  public array $options = [];

  #[\ReturnTypeWillChange]
  public function jsonSerialize()
  {
    return [
      'e' => $this->effect ?? PermissionEffect::Allow,
      'p' => $this->permission ?? null,
      'r' => $this->resource ?? '',
      'o' => $this->options ?? null,
    ];
  }
}
