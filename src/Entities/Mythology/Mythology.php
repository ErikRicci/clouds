<?php

namespace Clouds\Entities\Mythology;

use Clouds\Entities\Entity;
use Clouds\Entities\God\God;

class Mythology extends Entity
{
    private int $id;
    private string $name;
    /** @var God[] */
    private array $gods = [];

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

    /** @return God[] */
    public function getGods(): array
    {
        return $this->gods;
    }

    /** @param $gods God[] */
    public function setGods(array $gods): void
    {
        $this->gods = $gods;
    }
}
