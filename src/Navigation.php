<?php
namespace Kubex\Definitions;

class Navigation
{
  const LAUCH_MODE_PAGE = 'page';
  const LAUCH_MODE_MODAL = 'modal';
  const LAUCH_MODE_WINDOW = 'window';
  const LAUCH_MODE_OVERLAY = 'overlay';

  public string $icon;
  public Text $text;
  public Text $title;
  public string $destinationPath;
  public string $sectionID = '';//App Nav Only
  public IntegrationPoint $point;
  public string $launchMode = self::LAUCH_MODE_PAGE; //LAUCH_MODE_PAGE, LAUCH_MODE_MODAL, LAUCH_MODE_WINDOW, LAUCH_MODE_OVERLAY

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
