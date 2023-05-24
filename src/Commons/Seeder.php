<?php

namespace Clouds\Commons;

interface Seeder
{
    public static function generate(int $quantity): array;
}