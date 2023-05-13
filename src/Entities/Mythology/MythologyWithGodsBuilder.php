<?php

namespace Clouds\Entities\Mythology;

class MythologyWithGodsBuilder
{
    /** @return Mythology[] */
    public static function fromArray(array $data): array
    {
        $mythologies = [];
        foreach ($data as $mythology) {
            $mythologies[gak($mythology, 'id')]['id'] = gak($mythology, 'id');
            $mythologies[gak($mythology, 'id')]['name'] = gak($mythology, 'name');
            $mythologies[gak($mythology, 'id')]['gods'] = [];
        }
        foreach ($data as $mythology) {
            $mythologies[gak($mythology, 'id')]['gods_count'] = gak($mythology, 'gods_count');
            if (gak($mythology, 'god_name')) {
                $mythologies[gak($mythology, 'id')]['gods'][] = ['name' => gak($mythology, 'god_name')];
            }
        }

        return $mythologies;
    }
}
