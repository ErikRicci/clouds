<?php

namespace Clouds\Entities\God;

use Clouds\Entities\Entity;
use Clouds\Entities\Mythology\Mythology;

class God extends Entity
{
    private int $id;
    private string $name;
    private ?Mythology $mythology = null;
    private \DateTime $created_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
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

    public function getMythology(): Mythology
    {
        return $this->mythology;
    }

    public function setMythology(?Mythology $mythology): void
    {
        $this->mythology = $mythology;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime|string $created_at): void
    {
        $this->created_at = is_string($created_at)
            ? new \DateTime($created_at)
            : $created_at;
    }
}
