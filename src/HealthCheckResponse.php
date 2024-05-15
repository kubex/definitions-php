<?php

namespace Kubex\Definitions;

// Health check response should be returned json_encoded from the health check endpoint
class HealthCheckResponse
{
  public string $status;
  public bool $isHealthy;
  public int $nextRetry;
  public string $definitionHash;
}
