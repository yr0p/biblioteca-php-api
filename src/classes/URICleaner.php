<?php
namespace src\classes;

class URICleaner{
    public static function cleanURL($URL){
        return str_replace("api.biblioteca/", "", $URL);
    }
}