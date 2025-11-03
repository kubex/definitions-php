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

  public function permissionMeta(ScopedKey $permission): array
  {
    $meta = [];
    foreach($this->statements as $statement)
    {
      if($permission->key == $statement->permission->key)
      {
        if($statement->effect == PermissionEffect::Allow && !empty($statement->meta))
        {
          foreach($statement->meta as $metaKey => $metaValue)
          {
            $metaValue = is_array($metaValue) ? $metaValue : (is_object($metaValue) ? (array)$metaValue : [$metaValue]);
            if(!isset($meta[$metaKey]))
            {
              $meta[$metaKey] = $metaValue;
            }
            else
            {
              $meta[$metaKey] = array_merge($meta[$metaKey], $metaValue);
            }
          }
        }
      }
    }
    return $meta;
  }
}
