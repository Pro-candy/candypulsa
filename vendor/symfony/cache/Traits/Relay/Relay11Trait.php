<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Cache\Traits\Relay;

if (version_compare(phpversion('relay'), '0.11.0', '>=')) {
    /**
     * @internal
     */
    trait Relay11Trait
    {
        public function cmsIncrBy($key, $field, $value, ...$fields_and_falues): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->cmsIncrBy(...\func_get_args());
        }

        public function cmsInfo($key): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->cmsInfo(...\func_get_args());
        }

        public function cmsInitByDim($key, $width, $depth): \Relay\Relay|bool
        {
            return $this->initializeLazyObject()->cmsInitByDim(...\func_get_args());
        }

        public function cmsInitByProb($key, $error, $probability): \Relay\Relay|bool
        {
            return $this->initializeLazyObject()->cmsInitByProb(...\func_get_args());
        }

        public function cmsMerge($dstkey, $keys, $weights = []): \Relay\Relay|bool
        {
            return $this->initializeLazyObject()->cmsMerge(...\func_get_args());
        }

        public function cmsQuery($key, ...$fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->cmsQuery(...\func_get_args());
        }

        public function commandlog($subcmd, ...$args): \Relay\Relay|array|bool|int
        {
            return $this->initializeLazyObject()->commandlog(...\func_get_args());
        }

        public function hexpire($hash, $ttl, $fields, $mode = null): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hexpire(...\func_get_args());
        }

        public function hexpireat($hash, $ttl, $fields, $mode = null): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hexpireat(...\func_get_args());
        }

        public function hexpiretime($hash, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hexpiretime(...\func_get_args());
        }

        public function hgetdel($key, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hgetdel(...\func_get_args());
        }

        public function hgetex($hash, $fields, $expiry = null): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hgetex(...\func_get_args());
        }

        public function hpersist($hash, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hpersist(...\func_get_args());
        }

        public function hpexpire($hash, $ttl, $fields, $mode = null): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hpexpire(...\func_get_args());
        }

        public function hpexpireat($hash, $ttl, $fields, $mode = null): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hpexpireat(...\func_get_args());
        }

        public function hpexpiretime($hash, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hpexpiretime(...\func_get_args());
        }

        public function hpttl($hash, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->hpttl(...\func_get_args());
        }

        public function hsetex($key, $fields, $expiry = null): \Relay\Relay|false|int
        {
            return $this->initializeLazyObject()->hsetex(...\func_get_args());
        }

        public function httl($hash, $fields): \Relay\Relay|array|false
        {
            return $this->initializeLazyObject()->httl(...\func_get_args());
        }

        public function serverName(): false|string
        {
            return $this->initializeLazyObject()->serverName(...\func_get_args());
        }

        public function serverVersion(): false|string
        {
            return $this->initializeLazyObject()->serverVersion(...\func_get_args());
        }
    }
} else {
    /**
     * @internal
     */
    trait Relay11Trait
    {
    }
}
