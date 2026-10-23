<?php
namespace Kubex\Definitions;

class HelpArticle
{
  public string $id;
  /** @var string|HelpArticleType */
  public string $type;
  public Text $title;
  public Text $summary;
  public Text $content; // Plain text; paragraphs separated by blank lines
  public string $icon;
  public string $category;
  /** @var string[] */
  public array $tags = [];
  /** @var string[] */
  public array $keywords = [];
  public string $destinationPath;
  public string $externalUrl;
  public int $priority = 0;
  /** @var HelpPin[] */
  public array $pins = [];
}
