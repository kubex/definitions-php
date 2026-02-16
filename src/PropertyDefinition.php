<?php

namespace Kubex\Definitions;

class PropertyDefinition
{
  // Name Label for this attribute within the UI
  public Text $name;
  // Description
  public Text $description;
  // Help Text do display to assist the user with data input
  public Text $help;
  //Caption text to display under the input
  public Text $caption;
  // Placeholder text to display in the input placeholder / hints the input value
  public Text $placeholder;

  // Required Value of this attribute is required to be set
  public bool $required;
  // Nullable allow null to be set/returned for this attribute
  public bool $nullable;
  // PersonalData property contains personal data, encrypted on write, destroyed on a data delete request
  public bool $personalData;

  // Immutable Value of this attribute cannot be changed
  public bool $immutable;

  // WriteOnly Allows this value to be written, but not displayed within the UI
  public bool $writeOnly;

  // Annotations provide additional context
  // map[string]string
  public array $annotations = [];

  // AvailableValues provides a list of the possible options (if set, value must match)
  // map[string]string
  public array $availableValues = [];
  // RegexMatch attribute is validated against this regex
  public string $regexMatch;

  /** @var string|PropertyValue */
  public string $defaultValue;

  //DisplayType is the type of input to display
  /** @var string|PropertyDisplayType */
  public string $displayType;

  //DisplayFormat Format the output following the pattern xX0-()/\[]{}#%&*+~,.:;<>|@!?
  public string $displayFormat;

  // MaxOptions is the maximum number of elements that can be selected in a multi select
  public int $maxOptions;

  public bool $vendorShared = false; // Property is shared across all apps from the same vendor
  public bool $workspaceShared = false; // Property is shared across all apps in the same workspace
}
