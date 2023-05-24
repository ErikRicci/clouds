<?php

namespace Clouds\Entities\God;

use Clouds\Entities\Entity;
use Clouds\Entities\God\Enums\Alignment;

class God extends Entity
{
    private ?int $id;
    private string $name;
    private int $realm_id;
    private Alignment $alignment;
    private \DateTime $created_at;

    public function getId(): int
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

    public function getRealmId(): int
    {
        return $this->realm_id;
    }

    public function setRealmId(int $realm_id): void
    {
        $this->realm_id = $realm_id;
    }

    public function getAlignment(): Alignment
    {
        return $this->alignment;
    }

    public function setAlignment(Alignment|string $alignment): void
    {
        $this->alignment = is_string($alignment)
            ? Alignment::from($alignment)
            : $alignment;
    }
}
