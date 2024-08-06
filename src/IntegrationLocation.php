<?php
namespace Kubex\Definitions;

class IntegrationLocation
{
  public const Page = "page"; // Top Level Page Navigation
  public const Tab = "tab"; // Header Navigation on Page
  public const Action = "action"; // <app-actions>
  public const Panel = "panel"; // <app-panel>


  // @deprecated
  public const PageNav = self::Tab; // Header Navigation on Page
}
