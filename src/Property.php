<?php

namespace Kubex\Definitions;

class Property
{
  public string $key;
  /** @var string|PropertyType */
  public string $propertyType;
  public PropertyDefinition $definition;
}
