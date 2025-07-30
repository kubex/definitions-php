<?php

namespace Kubex\Definitions;

// Version data struct to return on /_kubex/version
class Version
{
  public string $environment; // Environment name (e.g., "production", "sandbox")
  public string $version; // Application version
  public string $buildTime; // Build date in RFC3339 format
  public string $buildID; // Build ID
  public string $commit; // Commit hash
}
