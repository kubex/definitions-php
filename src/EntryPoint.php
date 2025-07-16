<?php
namespace Kubex\Definitions;

class EntryPoint
{
  public string $icon;
  public Text $text;
  public Text $title;
  public string $destinationPath;
  public string $countPath;
  public string $launchMode = LaunchMode::Page;
  /** @var array<ScopedKey> */
  public array $requiredPermissions = [];

  public static function create($path, $text, string $icon = '', string $title = "", string $countPath = '')
  {
    $t = new static();
    $t->destinationPath = $path;
    $t->countPath = $countPath;
    $t->icon = $icon;
    $t->text = $text instanceof Text ? $text : Text::create($text);
    $t->title = $title === null ? '' : $t->text;

    if($title)
    {
      $t->title = $title instanceof Text ? $title : Text::create($title);
    }
    return $t;
  }

  public function requirePermission(ScopedKey $permission): self
  {
    $this->requiredPermissions[] = $permission;
    return $this;
  }
}
