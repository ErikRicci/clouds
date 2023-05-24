<?php

namespace Clouds\Commons;

abstract class EntityStream extends Stream
{
    public function getTable(): string
    {
        return $this->table;
    }

    public function validate()
    {
        $columns = [];
        foreach ($this->get() as $value) {
            if (empty($columns)) {
                $columns = array_keys($value);
            }
            $current_value_columns = array_keys($value);

            sort($current_value_columns);
            sort($columns);

            if ($current_value_columns !== $columns) {
                throw new \Exception('Malformed EntityStream. The values inside it do not share same columns');
            }
        }
    }
}