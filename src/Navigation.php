<?php
namespace Kubex\Definitions;

class Navigation
{
  public string $icon;
  public Text $text;
  public Text $title;
  public string $destinationPath;
  public string $sectionID = '';//App Nav Only
  public IntegrationPoint $point;
  public string $launchMode = LaunchMode::Page;

  public static function create($path, $text, string $icon = '', string $section = '')
  {
    $t = new static();
    $t->destinationPath = $path;
    $t->sectionID = $section;
    $t->icon = $icon;
    $t->text = $text instanceof Text ? $text : Text::create($text);
    return $t;
  }
}
