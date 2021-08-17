<?php
namespace Kubex\Definitions;

class NavigationSection
{
  public $id;
  public $priority;
  public $text;

  public static function create($id, $text, $priority = 50)
  {
    $t = new static();
    $t->id = $id;
    $t->priority = $priority;
    $t->text = $text instanceof Text ? $text : Text::create($text);
    return $t;
  }
}
