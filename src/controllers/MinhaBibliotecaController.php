<?php
namespace src\controllers;

use src\classes\Auth;
use src\helpers\Mensagem;
use src\helpers\MensagemSucesso;
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
    public function reservar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $minhaBiblioteca = new MinhaBiblioteca();
        $minhaBiblioteca->create($data["user"], $data["titulo"], $data["autor"], $data["path"]);
        Mensagem::mostrarMensagem(new MensagemSucesso, 200, "O livro foi adicionado a sua biblioteca com sucesso!");
    }
}