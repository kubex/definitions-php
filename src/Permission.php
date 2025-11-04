<?php
namespace Kubex\Definitions;

class Permission implements \JsonSerializable
{
  public string $key;
  public ?Text $name;
  public ?Text $description;
  /**
   * @var array<\Kubex\Definitions\PermissionMeta>
   */
  public array $meta = [];

  public static function create(string $key, $name, $description)
  {
    $t = new static();
    $t->key = $key;
    $t->name = $name instanceof Text ? $name : Text::create($name);
    $t->description = $description instanceof Text ? $description : Text::create($description);
    return $t;
  }

  public function jsonSerialize()
  {
    return array_filter([
      'key'         => $this->key,
      'name'        => $this->name,
      'description' => $this->description,
      'meta'        => $this->meta,
    ]);
  }

}
