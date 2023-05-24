<?php

namespace Clouds\Entities\Mythology\Struct;

class MythologyWithFollowersCount
{
    public readonly string $mythology_name;
    public readonly int $followers_count;

    public function __construct(
        string $mythology_name,
        int $followers_count,
    ) {
        $this->mythology_name = $mythology_name;
        $this->followers_count = $followers_count;
    }
}