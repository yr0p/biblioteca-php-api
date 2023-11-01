<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;
use Throwable;

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
    public function read($usuario)
    {
        $data = Connection::connect()->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        $data = $data->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function update($usuario, $nome, $email, $senha)
    {
        echo "UPDATE usuarios SET usuario = '$usuario', nome = '$nome', email = '$email', senha = '$senha' WHERE usuario = $usuario";

        Connection::connect()->query("UPDATE usuarios SET usuario = '$usuario', nome = '$nome', email = '$email', senha = '$senha' WHERE usuario = '$usuario'");
    }
    public function delete($usuario)
    {
        try
        {
            Connection::connect()->query("DELETE FROM usuarios WHERE usuario = '$usuario'");
        }
        catch(Throwable $er)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Usuario não existe! Ou já foi excluido!");
        }
    }
}