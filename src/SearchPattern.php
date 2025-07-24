<?php
namespace Kubex\Definitions;

class SearchPattern
{
  public string $regexMatch;      // A basic regex pattern to match text input
  public string $path;  // The endpoint to hit with the search query to fetch results
}
