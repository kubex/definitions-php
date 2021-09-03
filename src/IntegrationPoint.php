<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  public GlobalAppID $integrateApp;
  public string $pathID;
  /** @var string|\Kubex\Definitions\IntegrationLocation */
  public string $location;
}
