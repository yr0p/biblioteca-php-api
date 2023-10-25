<?php
namespace src\controllers;

use src\models\Livro;

class LivrosController
{
    public function livros($arg)
    {
        $livro = new Livro();
        $titulo = str_replace("-", " ", $arg[1]);
        echo json_encode($livro->read($titulo));
    }
}