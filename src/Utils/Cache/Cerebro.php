<?php

namespace Clouds\Utils\Cache;

class Cerebro
{
    private static bool $retrieved_from_cache;
    private const DEFAULT_TTL_IN_SECONDS = 60;

    public static function put(string $key, mixed $value, int $ttl = self::DEFAULT_TTL_IN_SECONDS): bool
    {
        $value = self::prepareValue($value);
        $redis = new \Redis();
        $redis->connect('redis', 6379, 3.5);
        $success = $redis->setex($key, $ttl, $value);

        return (bool) $success;
    }

    public static function get(string $key, callable $callback = null, int $ttl = self::DEFAULT_TTL_IN_SECONDS)
    {
        $redis = new \Redis();
        $redis->connect( 'redis', 6379, 3.5);
        $value = $redis->get($key);
        self::$retrieved_from_cache = true;

        if (empty($value)) {
            self::$retrieved_from_cache = false;
            if (! $callback) {
                return null;
            }

            $value = $callback();
            $redis->setex($key, $ttl, self::prepareValue($value));
        }

        return self::prepareRetrievedValue($value);
    }

    public static function wasRetrievedFromCache(): bool
    {
        return self::$retrieved_from_cache;
    }

    private static function prepareValue(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        } elseif (is_numeric($value)) {
            return strval($value);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_array($value)) {
            return implode(',', $value);
        } elseif (is_object($value)) {
            return serialize($value);
        } elseif (is_null($value)) {
            return '';
        } else {
            return (string) $value;
        }
    }

    private static function prepareRetrievedValue(mixed $value)
    {
        if (is_string($value)) {
            $decoded_value = json_decode($value);
            if (json_last_error() == JSON_ERROR_NONE) {
                return $decoded_value;
            }
            return @unserialize($value) ?: $value;
        } else {
            return $value;
        }
    }
}
