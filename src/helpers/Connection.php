<?php
namespace src\helpers;

use Exception;

class Connection
{
    public static function connect()
    {
        try{
            return new \PDO("mysql:dbname=biblioteca;host=localhost", "root", "root");
        }catch(Exception $e){
            Mensagem::mostrarMensagem(new MensagemErro, 404, "Erro ao tentar se conectar com o Banco de Dados!");
        }
    }
}