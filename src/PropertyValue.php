<?php

namespace Kubex\Definitions;

class PropertyValue
{
  public string $text;
  public int $number;
  public bool $bool;
  public float $float;
  public int $time;//Unix Timestamp
  public array $set = [];
  public array $map = [];
}
