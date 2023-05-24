<?php

namespace Clouds\Entities\Ability;

use Clouds\Entities\Ability\Enums\AbilityType;
use Clouds\Entities\Entity;

class Ability extends Entity
{
    private ?int $id;
    private string $name;
    private ?string $description;
    private ?AbilityType $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): AbilityType
    {
        return $this->type;
    }

    public function setType(AbilityType|string|null $type): void
    {
        $this->type = is_string($type)
            ? AbilityType::from($type)
            : $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}