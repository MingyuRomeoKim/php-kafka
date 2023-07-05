<?php

namespace MingyuKim\PhpKafka\Traits;

/**
 * 싱글톤
 */
trait TraitSingleton
{
    private static $instanse = null;

    /**
     *
     * @return self
     */
    static function getInstance()
    {
        if (self::$instanse == null) {
            self::$instanse = new self;
        }

        return self::$instanse;
    }
}