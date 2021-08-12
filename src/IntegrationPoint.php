<?php
namespace Kubex\Definitions;

class IntegrationPoint
{
  const LOCATION_NAV_PAGE = 'nav.page';
  const LOCATION_NAV_APP = 'nav.app';
  const LOCATION_ACTION = 'action';

  public GlobalAppID $integrateApp;
  public string $pathID;
  public string $location; //LOCATION_NAV_PAGE, LOCATION_NAV_APP, LOCATION_ACTION
}
