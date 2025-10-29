<?php
namespace Kubex\Definitions;

class PermissionConstraint
{
  public string $field;
  public string $type;
  public string $operator;
  public $value;

  #[\ReturnTypeWillChange]
  public function jsonSerialize()
  {
    return [
      'f' => $this->field,
      't' => $this->type,
      'o' => $this->operator,
      'v' => $this->value,
    ];
  }
}
