<?php
use src\helpers\Connection;

class Usuario{
    public static function create($nome, $email, $usuario, $senha){
        return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');
    }
    public static function read($nome, $email, $usuario, $senha){
        //return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');
    }
    public static function update($nome, $email, $usuario, $senha){
        //return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');
    }
    public static function delete($nome, $email, $usuario, $senha){
        //return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');
    }
}