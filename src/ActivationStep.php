<?php

namespace Kubex\Definitions;

class ActivationStep
{
  public string $id;
  public string $name;
  public string $description;
  public string $icon;
  public string $destinationPath;
  public string $instructionPath;
  public string $scope;
  public string $actionType;
  public bool $required;
}
