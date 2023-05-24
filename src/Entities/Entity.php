<?php

namespace Clouds\Entities;

use R2SArrayHelper\Traits\CanBeArray;

abstract class Entity implements \JsonSerializable
{
    use CanBeArray;

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

    public function __toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $key => $value) {
            $array[self::convertPascalToSnake($key)] = $value;
        }

        return $array;
    }

    private static function convertPascalToSnake($string): string
    {
        $string = preg_replace('/([a-z])([A-Z])/', '$1_$2', $string);
        return strtolower($string);
    }
}
