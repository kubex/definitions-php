<?php
namespace Kubex\Definitions;

class PermissionMeta
{
  public string $key;
  public Text $name;
  public Text $description;
  /** @var array<string, string> */
  public array $availableValues = [];
  /** @var string|PropertyType */
  public string $type;
  /** @var string|PropertyDisplayType */
  public string $displayType;

  public static function create(string $key, $name, $description)
  {
    $t = new static();
    $t->key = $key;
    $t->name = $name instanceof Text ? $name : Text::create($name);
    $t->description = $description instanceof Text ? $description : Text::create($description);
    return $t;
  }
}
