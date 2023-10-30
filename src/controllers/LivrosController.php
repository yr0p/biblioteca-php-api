<?php
namespace src\controllers;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;
use src\models\Livro;

class LivrosController
{
    public function livros($arg)
    {
        $livro = new Livro();
        $titulo = str_replace("-", " ", $arg[1]);
        echo json_encode($livro->read($titulo));
    }
    public function registerBook()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $livro = new Livro();
        $livro->create($data["titulo"], $data["autor"], $data["data_lancamento"], $data["quantidade_paginas"], $data["descricao"], $data["imagem_capa"]);
        Mensagem::mostrarMensagem(new MensagemErro, 200, "Livro criado com sucesso!");
    }
    public function verLivros()
    {
        $livro = new Livro();
        $livros = $livro->read("");

        echo json_encode($livros);
    }
    public function updateBook()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $livroTable = new Livro();
        $livroTable->update($data["cod"], $data["titulo"], $data["autor"], $data["data_lancamento"], $data["quantidade_paginas"], $data["descricao"], $data["imagem_capa"]);
        Mensagem::mostrarMensagem(new MensagemErro, 200, "Livro atualizado com sucesso!");
    }
    public function deleteBook($arg)
    {
        $livro = str_replace("-", " ", $arg[1]);
        $livroTable = new Livro();
        $livroTable->delete($livro);
        Mensagem::mostrarMensagem(new MensagemErro, 200, "Livro deletado com sucesso!");
    }
}