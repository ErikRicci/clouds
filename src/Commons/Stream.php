<?php

namespace Clouds\Commons;

class Stream
{
    private array $content;
    private array $filtered_content;
    private array $details;

    public function __construct(array $content, array $details = [])
    {
        $this->content = $content;
        $this->details = $details;
    }

    public static function empty(): self
    {
        return new self([]);
    }

    public function push(mixed $value): self
    {
        $this->content[] = $value;
        return $this;
    }

    public function each(callable $callback)
    {
        foreach ($this->getContent() as $item) {
            $callback($item);
        }
    }

    public function where(callable $callback): self
    {
        $this->filtered_content = array_filter($this->content, $callback);
        return $this;
    }

    public function whereLike(string $key, mixed $like): self
    {
        $this->filtered_content = array_filter($this->content, fn ($v) => str_contains(strtolower(gak($v, $key)), strtolower($like)));
        return $this;
    }

    public function get(): array
    {
        return $this->getContent();
    }

    public function count(): int
    {
        return sizeof($this->getContent());
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    private function getContent()
    {
        return $this->filtered_content ?? $this->content;
    }
}
