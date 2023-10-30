<?php
namespace src\models;

use src\helpers\Connection;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;
use Throwable;

class Livro
{
    public function create($titulo, $autor, $dataLancamento, $quantidadePaginas, $descricao, $imagem_capa)
    {
        try
        {
            return Connection::connect()->query("INSERT INTO livros(titulo, autor, data_lancamento, quantidade_paginas, descricao, imagem_capa) VALUES('$titulo', '$autor', '$dataLancamento', '$quantidadePaginas', '$descricao', '$imagem_capa')");
        }
        catch(Throwable $er)
        {
            echo $er->getMessage();
        }
    }
    public function read($titulo)
    {   
        try
        {
            $data = Connection::connect()->query("SELECT * FROM livros WHERE titulo LIKE '%$titulo%'");
            $data = $data->fetchAll(\PDO::FETCH_ASSOC);
            
            if(empty($data[0])){
                Mensagem::mostrarMensagem(new MensagemErro, 400, 'Livro não encontrado!');
            }
            return $data;
        }
        catch(Throwable $er)
        {
            echo $er->getMessage();
        }
    }
    public function update($cod, $titulo, $autor, $dataLancamento, $quantidadePaginas, $descricao, $imagem_capa) 
    {
        return Connection::connect()->query("UPDATE livros SET titulo = '$titulo', autor = '$autor', data_lancamento = '$dataLancamento', quantidade_paginas = '$quantidadePaginas', descricao = '$descricao', imagem_capa = '$imagem_capa' WHERE cod = $cod"
        );
        
    }
    public function delete($titulo)
    {
        try
        {
            Connection::connect()->query("DELETE FROM livros WHERE titulo = '$titulo'");
        }
        catch(Throwable $er)
        {
            echo $er->getMessage();
        }
        
    }
}