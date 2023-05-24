<?php

namespace Clouds\Entities\God\Repository;

use Clouds\Entities\Ability\Ability;
use Clouds\Entities\Ability\AbilityBuilder;
use Clouds\Entities\Ability\Stream\AbilityStream;
use Clouds\Entities\God\God;
use Clouds\Entities\God\GodBuilder;
use Clouds\Entities\God\Struct\GodWithAbilities;
use Oracle\Oracle;

class GetGodsWithAbilities
{
    private const QUERY = "
        SELECT
            g.id,
            g.name,
            r.id AS realm_id,
            r.name AS realm_name,
            GROUP_CONCAT(a.name) AS abilities,
            g.alignment
        FROM gods g
        JOIN realms r ON g.realm_id = r.id
        LEFT JOIN god_ability ga ON g.id = ga.god_id
        LEFT JOIN abilities a ON ga.ability_id = a.id
        GROUP BY g.id
        LIMIT 5
    ";

    /** @return GodWithAbilities[] */
    public function execute(): array
    {
        $result = Oracle::getInstance()->select(self::QUERY);
        return array_map(fn ($row) => new GodWithAbilities($this->buildGod($row), AbilityStream::with($this->buildAbilities($row))->get()), $result);
    }

    private function buildGod(array $row): God
    {
        return GodBuilder::fromArray([
            'id' => gak($row, 'id'),
            'name' => gak($row, 'name'),
            'alignment' => gak($row, 'alignment'),
            'realm_id' => gak($row, 'realm_id')
        ]);
    }

    /** @return Ability[] */
    private function buildAbilities(array $row): array
    {
        $abilities = gak($row, 'abilities');
        if (! $abilities) {
            return [];
        }
        $abilities_array = explode(',', $abilities);
        return array_map(fn ($ability_name) => AbilityBuilder::fromArray(['name' => $ability_name]), $abilities_array);
    }
}