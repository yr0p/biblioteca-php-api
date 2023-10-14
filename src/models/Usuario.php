<?php
require_once "./models/Usuario.php";
class Usuario{
    public static function create($nome, $email, $usuario, $senha){
        return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');
    }
}