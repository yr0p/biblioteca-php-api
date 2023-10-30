<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;
use Throwable;

class MinhaBiblioteca
{
    public function create($user, $titulo, $autor, $path)
    {
        try{
            $rows = Connection::connect()->query("SELECT * from minha_biblioteca WHERE titulo = '$titulo' AND user = '$user'");

            if($rows->rowCount() > 0)
            {
                Mensagem::mostrarMensagem(new MensagemErro, 400, "Você já adicionou esse livro!");
            }
            Connection::connect()->query("INSERT INTO minha_biblioteca(user, titulo, autor, path) values('$user', '$titulo', '$autor', '$path')");
        }
        catch(Throwable $er)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Erro ao mandar para Minha Biblioteca!");
        }
    }
    public function read($user)
    {   
        try
        {
            $data = Connection::connect()->query("SELECT titulo FROM minha_biblioteca WHERE user = '$user'");
        }
        catch(Throwable $er)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Erro no banco de dados!");
        }
        
        $data = $data->fetchAll(\PDO::FETCH_ASSOC);
        
        if(empty($data[0]))
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Livro não encontrado!");
        }
        return $data;
    }
}