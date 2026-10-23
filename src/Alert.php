<?php
namespace Kubex\Definitions;

class Alert
{
  public string $title = '';
  public string $description = '';
  public string $style = '';
  public string $icon = '';
  public bool $closer = false;
  /** @var AlertButton[] */
  public array $actions = [];

  public static function create(string $title, string $description = '', string $icon = ''): self
  {
    $alert = new static();
    $alert->title = $title;
    $alert->description = $description;
    $alert->icon = $icon;
    return $alert;
  }

  public function withAction(AlertButton ...$actions): self
  {
    array_push($this->actions, ...$actions);
    return $this;
  }

  public function withClose(): self { $this->closer = true; return $this; }
  public function info(): self { $this->style = AlertStyle::Info; return $this; }
  public function warning(): self { $this->style = AlertStyle::Warning; return $this; }
  public function success(): self { $this->style = AlertStyle::Success; return $this; }
  public function danger(): self { $this->style = AlertStyle::Danger; return $this; }

  public function writeHeader(): void
  {
    header(Headers::ResponseAlert . ': ' . json_encode($this, JSON_THROW_ON_ERROR));
  }
}
