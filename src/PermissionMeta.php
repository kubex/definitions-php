<?php
namespace Kubex\Definitions;

class PermissionMeta implements \JsonSerializable
{
  public string $key;
  public ?Text $name = null;
  public ?Text $description = null;
  /** @var array<string, string> */
  public array $availableValues = [];
  /** @var string|PropertyType */
  public string $type = '';
  /** @var string|PropertyDisplayType */
  public string $displayType = '';

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
      'key'             => $this->key,
      'name'            => $this->name,
      'description'     => $this->description,
      'availableValues' => $this->availableValues,
      'type'            => $this->type,
      'displayType'     => $this->displayType,
    ]);
  }

}
