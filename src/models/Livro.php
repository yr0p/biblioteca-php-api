<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;

class Livro
{
    public function create($titulo, $autor, $dataLancamento, $quantidadePaginas)
    {
        $data = $this->read($titulo);

        if($data = null)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "O user fornecido já está em uso!");
        }
        return Connection::connect()->query('INSERT INTO livros(titulo, autor, data_lancamento, quantidade_paginas, descricao, imagem_capa) VALUES("'. $titulo. '", "'. $autor . '", "' . $dataLancamento . '", "'. $quantidadePaginas . '")');

    }
    public function read($titulo )
    {   
        $data = Connection::connect()->query("SELECT * FROM livros WHERE titulo LIKE '%$titulo%'");
        $data = $data->fetchAll(\PDO::FETCH_ASSOC);
        
        if(empty($data[0])){
            Mensagem::mostrarMensagem(new MensagemErro, 400, 'Livro não encontrado!');
        }
        return $data;
    }
}