<?php

if (! function_exists('gak')) {
    function gak(
        array|object $data,
        string|int $key,
        mixed $default = null
    ): mixed {
        if (is_object($data)) {
            if (property_exists($data, $key)) {
                $value = $data->$key;
            }
        } else {
            if (array_key_exists($key, $data)) {
                $value = $data[$key];
            }
        }

        if (!isset($value)) {
            return $default;
        }

        return $value;
    }
}

if (! function_exists('now')) {
    function now(): \DateTime
    {
        return new \DateTime();
    }
}

if (! function_exists('dd')) {
    function dd(...$vars): void
    {
        echo "<pre>";
        var_dump(...$vars);
        echo "</pre>";
        die();
    }
}
