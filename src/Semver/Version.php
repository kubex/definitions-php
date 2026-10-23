<?php
namespace Kubex\Definitions\Semver;

// Separate from the application build metadata in Kubex\Definitions\Version.
class Version
{
  public int $major = 0;
  public int $minor = 0;
  public int $patch = 0;
  /** @var string[] */
  public array $preRelease = [];
  /** @var string[] */
  public array $build = [];

  public static function parse(string $input): self
  {
    $version = new static();
    $coreAndBuild = explode('+', trim($input), 2);
    $coreAndPreRelease = explode('-', $coreAndBuild[0], 2);
    $parts = explode('.', $coreAndPreRelease[0]);
    if(count($parts) !== 3)
    {
      return $version;
    }
    foreach($parts as $part)
    {
      if(!preg_match('/^[0-9]+$/D', $part) || (float)$part > 65535)
      {
        return $version;
      }
    }
    [$version->major, $version->minor, $version->patch] = array_map('intval', $parts);
    if(($coreAndPreRelease[1] ?? '') !== '')
    {
      $version->preRelease = explode('.', $coreAndPreRelease[1]);
    }
    if(($coreAndBuild[1] ?? '') !== '')
    {
      $version->build = explode('.', $coreAndBuild[1]);
    }
    return $version;
  }

  public function getMajor(): int { return $this->major; }
  public function getMinor(): int { return $this->minor; }
  public function getPatch(): int { return $this->patch; }
  public function getPreRelease(): array { return $this->preRelease; }
  public function getBuild(): array { return $this->build; }

  public function __toString(): string
  {
    $version = $this->major . '.' . $this->minor . '.' . $this->patch;
    if($this->preRelease)
    {
      $version .= '-' . implode('.', $this->preRelease);
    }
    if($this->build)
    {
      $version .= '+' . implode('.', $this->build);
    }
    return $version;
  }
}
