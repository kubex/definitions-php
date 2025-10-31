<?php
namespace Kubex\Definitions;

class PermissionMeta
{
  public string $key;
  public Text $name;
  public Text $description;
  public PermissionOption $option;

  public static function create(string $key, $name, $description)
  {
    $t = new static();
    $t->key = $key;
    $t->name = $name instanceof Text ? $name : Text::create($name);
    $t->description = $description instanceof Text ? $description : Text::create($description);
    return $t;
  }
}
