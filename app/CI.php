<?php

namespace App;

class CI
{
    /** @var CI */
    public static $app;

    public $session;

    public static function init()
    {
        if (static::$app) return;

        static::$app = new static();

        helper(['session']);

        (static::$app)->session = session();
    }
}