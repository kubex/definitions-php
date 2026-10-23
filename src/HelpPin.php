<?php
namespace Kubex\Definitions;

class HelpPin
{
  public ScopedKey $app; // Unset means the owning app
  public string $pathRegex;
  public int $priority = 0;
}
