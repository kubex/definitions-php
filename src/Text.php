<?php
namespace Kubex\Definitions;

class Text
{
  public $fallback;
  public $translations;//[lang]text

  public static function create($default)
  {
    $t = new static();
    $t->fallback = $default;
    return $t;
  }

  public function setText($language, $text)
  {
    $this->translations[$language] = $text;
    return $this;
  }
}
