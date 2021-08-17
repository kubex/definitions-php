<?php
namespace Kubex\Definitions;

class Definition
{
  public $id;
  public $endpoint;

  public $name;
  public $description;

  public $UIMode;
  public $dependencies = [];//[]GlobalAppID
  public $icon = 'pending';//material design icon
  public $paths = [];
  public $permissions = [];//[]Permission
  public $unify = [];//[]Navigation
}
