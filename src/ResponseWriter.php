<?php
namespace Kubex\Definitions;

class ResponseWriter
{
  /** @var array<string, string> */
  private array $headers = [];
  private int $statusCode = 0;

  public static function create(): self
  {
    return new static();
  }

  public function refresh(): self
  {
    $this->headers[Headers::ResponseRefresh] = 'self';
    return $this;
  }

  public function noContent(): self
  {
    $this->statusCode = 204;
    return $this;
  }

  public function refreshFragment(string ...$fragments): self
  {
    $this->headers[Headers::ResponseRefresh] = implode(',', $fragments);
    return $this;
  }

  public function refreshSpace(string ...$uris): self
  {
    return $this->refreshFragment(...$uris);
  }

  public function refreshReferer(): self
  {
    $this->headers[Headers::ResponseRefresh] = 'referer';
    return $this;
  }

  public function refreshDataTable(string ...$selectors): self
  {
    $this->headers[Headers::ResponseRefreshDataTable] = $selectors ? implode(',', $selectors) : 'self';
    return $this;
  }

  public function closeModal(): self
  {
    $this->headers[Headers::ResponseCloseModal] = '1';
    return $this;
  }

  public function getHeaders(): array { return $this->headers; }
  public function getStatusCode(): int { return $this->statusCode; }

  public function write(): void
  {
    foreach($this->headers as $name => $value)
    {
      header($name . ': ' . $value);
    }
    if($this->statusCode !== 0)
    {
      http_response_code($this->statusCode);
    }
  }
}
