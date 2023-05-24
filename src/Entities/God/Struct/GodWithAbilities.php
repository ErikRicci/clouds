<?php

namespace Clouds\Entities\God\Struct;

use Clouds\Commons\Struct;
use Clouds\Entities\Ability\Ability;
use Clouds\Entities\God\God;

class GodWithAbilities extends Struct
{
    public readonly God $god;

    /** @var Ability[] $abilities */
    public readonly array $abilities;

    public function __construct(
        God $god,
        array $abilities,
    ) {
        $this->god = $god;
        $this->abilities = $abilities;
    }
}