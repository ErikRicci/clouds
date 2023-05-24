<?php

namespace Clouds\Entities\Ability\Enums;

enum AbilityType: string
{
    case SKILL = 'skill';
    case CURSE = 'curse';
    case ATTRIBUTE = 'attribute';
}
