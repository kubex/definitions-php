<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  public GlobalAppID $integrateApp;
  /** @var string|IntegrationLocation */
  public string $location;
  public string $pathID;
  public Navigation $navigation;
}
