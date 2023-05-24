<?php

namespace Clouds\Commons;

// TODO: Consider transforming this into an Interface
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

    public static function with(array $content)
    {
        return new static($content);
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

        return $this;
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

    public function getKeys(): ?array
    {
        $content = $this->getContent();
        $first_item = reset($content);

        if (! $first_item) {
            return null;
        }

        if (is_array($first_item)) {
            return array_keys($first_item);
        } elseif ($first_item instanceof \stdClass) {
            return get_object_vars($first_item);
        } else {
            $class = new \ReflectionClass($first_item);
            $properties = [];
            foreach ($class->getProperties() as $property) {
                $properties[] = $property->getName();
            }
            return $properties;
        }
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
