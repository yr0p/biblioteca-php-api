<?php
namespace src\controllers;

use src\classes\Auth;
use src\models\MinhaBiblioteca;

class MinhaBibliotecaController
{
    public function meusLivros()
    {
        $headers = getallheaders();
        $token = $headers['Authorization'];
        $auth = new Auth();
        $decode = $auth->decode($token, getenv('SECRET'));
        $minhaBiblioteca = new MinhaBiblioteca();
        $livrosDoUsuario = $minhaBiblioteca->read($decode->user);

        echo json_encode($livrosDoUsuario);
    }
}