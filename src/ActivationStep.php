<?php

namespace Kubex\Definitions;

class ActivationStep
{
  public string $id;
  public Text $name;
  public Text $description;
  public string $icon;
  public string $destinationPath;
  public string $instructionPath;

  /** @var string|ActivationScope */
  public string $scope;
public int $priority;
  /** @var string|ActivationActionType */
  public string $actionType;
  public bool $required;
}
