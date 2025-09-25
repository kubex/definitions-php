<?php
namespace Kubex\Definitions;

class UIMode
{
  public const Full = "full"; // Standard application
  public const Dextral = "dextral"; // Dextral application
  public const Basic = "basic"; // Simple application - used for non-native applications
  public const Integration = "integration"; // Integrated into existing pages
  public const Help = "help"; // Help App
  public const None = "none"; // No UI - flow only
}
