<?php
namespace Kubex\Definitions;

class Navigation
{
  public string $icon;
  public Text $text;
  public Text $title;
  public string $destinationPath;
  public string $launchMode = LaunchMode::Page;

  public static function create($path, $text, string $icon = '', string $title = "")
  {
    $t = new static();
    $t->destinationPath = $path;
    $t->icon = $icon;
    $t->text = $text instanceof Text ? $text : Text::create($text);
    $t->title = $t->text;

    if($title)
    {
      $t->title = $title instanceof Text ? $title : Text::create($title);
    }
    return $t;
  }
}
