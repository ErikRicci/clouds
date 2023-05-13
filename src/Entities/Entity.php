<?php

namespace Clouds\Entities;

abstract class Entity implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        $reflection = new \ReflectionClass($this);
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $properties[$property->getName()] = $this->resolvePropertyValue($property->getValue($this));
        }
        return $properties;
    }

    private function resolvePropertyValue(mixed $property)
    {
        return match (true) {
            $property instanceof \DateTime => $property->format("Y-m-d H:i:s"),
            default => $property,
        };
    }
}
