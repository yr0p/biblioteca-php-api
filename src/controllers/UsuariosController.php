<?php
namespace src\controllers;

use src\classes\Auth;

use src\helpers\Mensagem;
use src\helpers\Sanitaze;
use src\helpers\Verifications;
use src\helpers\MensagemSucesso;
use src\helpers\MensagemErro;

use src\models\Usuario;

class UsuariosController
{
    public function registerUser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $verifica = new Verifications();
        $verifica->isEmpty($data);

        $name = $data["name"];
        $email = $data["email"];
        $user = $data["user"];
        $password = $data["password"];
        $passwordConfirm = $data["passwordConfirm"];

        $verifica->charsLimite($user, $password, $passwordConfirm, $email, $name);
        $verifica->email($email);
        $verifica->password($password, $passwordConfirm);

        $data = Sanitaze::limpar($user, $password, $email, $name);
        $usuario = new Usuario();
        $usuario->create($data["name"], $data["email"], $data["user"], $data["password"]);
        Mensagem::mostrarMensagem(new MensagemSucesso, 200, "Usuário cadastrado com sucesso!");
    }
    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $user = $data["user"];
        $password = $data["password"];

        $userTable = new Usuario();
        $auth = new Auth();

        $data = $userTable->read($user);
        $result = null;
        foreach($data as $usr)
        {
            if($usr['usuario'] == $user && $usr['senha'] == $password)
            {
                $result = $user;
            }
        }
        if($result == null)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "User ou Password não existe!");
        }
        $token = $auth->create($result);
    }
    public function userDecode()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $auth = new Auth();
        $data = $auth->decode($data["Authorization"], getenv("SECRET"));

        echo json_encode(["user" => $data->user]);
    }
    public function getUser()
    {
        $headers = getallheaders();
        $token = $headers['Authorization'];
        $auth = new Auth();
        $decode = $auth->decode($token, getenv('SECRET'));

        $usuario = new Usuario();
        $user = $usuario->read($decode->user);

        echo json_encode($user);
    }
    public function deleteUser()
    {
        $headers = getallheaders();
        $token = $headers['Authorization'];
        $auth = new Auth();
        $decode = $auth->decode($token, getenv('SECRET'));

        $usuario = new Usuario();
        $usuario->delete($decode->user);
        Mensagem::mostrarMensagem(new MensagemSucesso, 200, "Usuário foi excluido!");
    }
    public function updateUser()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $headers = getallheaders();
        $token = $headers['Authorization'];
        $auth = new Auth();
        $decode = $auth->decode($token, getenv('SECRET'));

        $usuario = new Usuario();
        $usuario->update($data["usuario"], $data["nome"], $data["email"], $data["senha"]);
        Mensagem::mostrarMensagem(new MensagemSucesso, 200, "O usuário foi atualizado!");
    }
}