<?php

namespace Clouds\Commons;

use Clouds\Entities\Entity;
use Oracle\Oracle;

class Repository
{
    private string $table;

    private function __construct(string $table)
    {
        $this->table = $table;
    }

    public static function forTable(string $table): self
    {
        return new self($table);
    }

    public function where(string $condition = '1 = 1', array $columns = ['*']): array
    {
        $columns_array = implode(', ', $columns);

        return Oracle::getInstance()
            ->select("SELECT $columns_array FROM $this->table WHERE $condition");
    }

    public function firstWhere(string $condition = '1 = 1', array $columns = ['*']): array|false
    {
        $columns_array = implode(', ', $columns);

        $result = Oracle::getInstance()
            ->select("SELECT $columns_array FROM $this->table WHERE $condition");
        return reset($result);
    }

    public function insert(Entity $entity): Entity|false
    {
        $columns = $this->getColumns();
        $array_entity = json_decode(json_encode($entity), true);
        $array_entity = array_filter($array_entity, fn ($value) => !empty($value));
        $columns = implode(', ', array_intersect($columns, array_keys($array_entity)));

        // TODO: Maybe another class to handle this?
        $stringified_values = $this->buildInsertValueStatement($array_entity);

        $success = Oracle::getInstance()
            ->getDB()
            ->prepare("INSERT INTO $this->table($columns) VALUES $stringified_values")
            ->execute();

        if ($success) {
            $entity->setId(Oracle::getInstance()->getDB()->lastInsertId());
            return $entity;
        }

        return false;
    }

    public function insertBulk(EntityStream $stream): bool
    {
        $columns = $this->getColumns();
        $columns = implode(', ', array_intersect($columns, $stream->getKeys()));
        $stream->validate();

        // TODO: Maybe another class to handle this?
        $values = array_map(fn ($value) => $this->buildInsertValueStatement($value), $stream->get());
        $stringified_values = implode(', ', $values);

        return Oracle::getInstance()
            ->getDB()
            ->prepare("INSERT INTO $this->table($columns) VALUES $stringified_values")
            ->execute();
    }

    public function getColumns(): array
    {
        $result = Oracle::getInstance()
            ->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->table'");
        return array_map(fn ($row) => $row['COLUMN_NAME'], $result);

    }

    private function buildInsertValueStatement(array $row): string
    {
        return "(".implode(', ', array_map(fn ($column_value) => Oracle::getInstance()->getDB()->quote($column_value), $row)).")";
    }
}