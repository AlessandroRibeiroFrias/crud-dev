<?php
namespace  App\Infrastructure\Connection;

class DBConfig
{
    public static $HOST = '';
    public static $DATABASE = '';
    public static $USER = '';
    public static $PASSWORD = '';

    public static function loadConfig()
    {
        self::$HOST ='192.168.99.100';
        self::$DATABASE = 'dev';
        self::$USER = 'root';
        self::$PASSWORD = 'examplepass';
    }
}