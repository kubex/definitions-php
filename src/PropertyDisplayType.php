<?php

namespace Kubex\Definitions;

class PropertyDisplayType
{
  public const Text = "text"; // text
  public const TextBlock = "text-block"; // long text
  public const Toggle = "toggle"; // bool
  public const Int = "int"; // int
  public const Float = "float"; // float
  public const Date = "date"; // date
  public const Time = "time"; // time
  public const Timestamp = "timestamp"; // unix timestamp int
  public const Link = "link"; // string
  public const Checkbox = "checkbox"; // checkbox
  public const Radio = "radio"; // radio
  public const Email = "email"; // email
  public const Phone = "phone"; // phone
  public const Amount = "amount"; // amount + currency
  public const Address = "address"; // string
}
