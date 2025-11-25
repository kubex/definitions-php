<?php
namespace Kubex\Definitions;

class Resource
{
  /**
   * @var string
   */
  public $id;

  /**
   * @var int
   */
  public $level;

  /**
   * @var string
   */
  public $display;

  public function __construct(string $id = "", int $level = 0, string $display = "")
  {
    $this->id = $id;
    $this->level = $level;
    $this->display = $display;
  }

  /**
   * Parses a comma-separated string of resource data into an array of Resource objects.
   * * Expected format for each segment: ID.Level:Display
   * Example: "wood.10:Wood Storage,stone.5:Stone Quarry"
   *
   * @param string $from The input string, e.g., "ID.Level:Display,ID2.Level2:Display2"
   *
   * @return Resource[] An array of Resource objects.
   */
  public static function fromHeader(string $from): array
  {
    $resources = [];
    $rawRes = explode(",", $from);

    foreach($rawRes as $res)
    {
      $res = trim($res);
      if(empty($res))
      {
        continue;
      }

      $resource = new Resource();
      $dis = explode(":", $res, 2);

      if(count($dis) == 2)
      {
        $resource->display = $dis[1];
        $res = $dis[0];
      }

      $lvl = explode(".", $res, 2);

      if(count($lvl) == 2)
      {
        $resource->level = (int)$lvl[1];
      }

      $resource->id = $lvl[0];

      if($resource->id != "")
      {
        $resources[] = $resource;
      }
    }

    return $resources;
  }
}

