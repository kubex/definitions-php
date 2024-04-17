<?php
namespace Kubex\Definitions;

class PermissionPolicy
{
  public string $uuid;
  public Text $name;
  public Text $description;
  /**
   * @var array<PermissionStatement>
   */
  public array $statements = [];

  public function hasPermission(ScopedKey ...$permissions): bool
  {
    foreach($permissions as $permission)
    {
      $allow = false;
      foreach($this->statements as $statement)
      {
        if($permission->key == $statement->permission->key)
        {
          if($statement->effect == PermissionEffect::Deny)
          {
            return false;
          }
          else
          {
            $allow = true;
          }
        }
      }
      if(!$allow)
      {
        return false;
      }
    }
    return true;
  }
}
