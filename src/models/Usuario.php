<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;

class Usuario
{
    public function create($nome, $email, $usuario, $senha)
    {
        $data = Connection::connect()->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        if($data->rowCount() > 0)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "O user fornecido já está em uso!");
        }
        return Connection::connect()->query('INSERT INTO usuarios(nome, email, usuario, senha) VALUES("'. $nome. '", "'. $email . '", "' . $usuario . '", "'. $senha . '")');

    }
    public function read($usuario, $senha)
    {
        $data = Connection::connect()->query('SELECT * FROM usuarios');
        $data = $data->fetchAll(\PDO::FETCH_ASSOC);
        $result = null;
        foreach($data as $user)
        {
            if($user['usuario'] == $usuario && $user['senha'] == $senha)
            {
                $result = $user;
            }
        }
        if($result == null)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "User ou Password não existe!");
        }
        return $result;
    }
    
}