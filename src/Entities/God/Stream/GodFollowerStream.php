<?php

namespace Clouds\Entities\God\Stream;

use Clouds\Commons\Stream;

class GodFollowerStream extends Stream
{
    public function __construct(array $content, int $god_id)
    {
        parent::__construct($content, ['god' => $god_id]);
    }

    public function getGod(): int
    {
        return $this->getDetails()['god'];
    }
}
