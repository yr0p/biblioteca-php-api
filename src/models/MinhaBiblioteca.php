<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;
use Throwable;

class MinhaBiblioteca
{
    public function create()
    {

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