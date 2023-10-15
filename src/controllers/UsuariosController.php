<?php
namespace src\controllers;

use src\classes\Auth;

use src\helpers\Mensagem;
use src\helpers\Sanitaze;
use src\helpers\Verifications;
use src\helpers\MensagemSucesso;

use src\models\Usuario;

class UsuariosController
{
    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $name = $data["name"];
        $email = $data["email"];
        $user = $data["user"];
        $password = $data["password"];
        $passwordConfirm = $data["passwordConfirm"];

        $verifica = new Verifications();
        $verifica->isEmpty($user, $password, $passwordConfirm, $email, $name);
        $verifica->charsLimite($user, $password, $passwordConfirm, $email, $name);
        $verifica->email($email);
        $verifica->password($password, $passwordConfirm);

        $data = Sanitaze::limpar($user, $password, $passwordConfirm, $email, $name);

        $usuario = new Usuario();
        $usuario->create($data["name"], $data["user"], $data["user"], $data["password"]);
        Mensagem::mostrarMensagem(new MensagemSucesso, 200, "Usuário cadastrado com sucesso!");
    }
    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $user = $data["user"];
        $password = $data["password"];
        $userTable = new Usuario();
        $auth = new Auth();

        $data = $userTable->read($user, $password);
        
        $auth->create($data);
    }
}