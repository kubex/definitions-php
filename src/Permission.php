<?php
namespace Kubex\Definitions;

class Permission
{
  public PermissionKey $key;
  public Text $name;
  public Text $description;

  public static function create($key, $name, $description)
  {
    $t = new static();
    $t->key = PermissionKey::create($key);
    $t->name = $name instanceof Text ? $name : Text::create($name);
    $t->description = $description instanceof Text ? $description : Text::create($description);
    return $t;
  }
}
