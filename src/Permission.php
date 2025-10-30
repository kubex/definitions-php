<?php
namespace Kubex\Definitions;

class Permission
{
  public string $key;
  public Text $name;
  public Text $description;
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
}
