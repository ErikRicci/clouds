<?php

namespace Clouds\Entities\FollowersMetric;

use Clouds\Entities\Entity;

class FollowersMetric extends Entity
{
    private int $id;
    private int $god_id;
    private int $new_followers;
    private int $leaving_followers;
    private \DateTime $date;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getGodId(): int
    {
        return $this->god_id;
    }

    public function setGodId(int $god_id): void
    {
        $this->god_id = $god_id;
    }

    public function getNewFollowers(): int
    {
        return $this->new_followers;
    }

    public function setNewFollowers(int $new_followers): void
    {
        $this->new_followers = $new_followers;
    }

    public function getLeavingFollowers(): int
    {
        return $this->leaving_followers;
    }

    public function setLeavingFollowers(int $leaving_followers): void
    {
        $this->leaving_followers = $leaving_followers;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }
}