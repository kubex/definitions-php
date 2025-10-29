<?php
namespace Kubex\Definitions;

class PermissionConstraintDefinition
{
  public string $field;
  public string $type;

  public static function create(string $field, $type)
  {
    $t = new static();
    $t->field = $field;
    $t->type = $type;
    return $t;
  }
}
