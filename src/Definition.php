<?php
namespace Kubex\Definitions;

class Definition
{
  public GlobalAppID $id;
  public string $endpoint;

  public Text $name;
  public Text $description;

  public string $UIMode;
  public array $dependencies = [];//[]GlobalAppID
  public string $icon = 'pending';//material design icon
  public array $paths = [];
  public array $permissions = [];//[]Permission
  public array $unify = [];//[]Navigation
}
