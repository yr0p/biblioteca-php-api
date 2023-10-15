<?php
namespace src\helpers;

class Connection
{
    public static function connect()
    {
        return new \PDO("mysql:dbname=biblioteca;host=localhost", "root", "root");
    }
}