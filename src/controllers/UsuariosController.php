<?php
namespace src\controllers;

use src\helpers\MensagemErro;

class UsuariosController
{
    public function register(){
        $data = json_decode(file_get_contents('php://input'), true);

        if(empty($data["nome"]) || empty($data["email"]) || empty($data["usuario"]) || empty($data["senha"])){
            
        }

        $nome = $data["nome"];
        $email = $data["email"];
        $user = $data["usuario"];
        $senha = $data["senha"];

        if((strlen($nome) > 100) || (strlen($email) > 100) || (strlen($user) > 100) || (strlen($senha) > 100)){
            MensagemErro::mostrarMensagem(400, "Alguns dos dados estão excedendo o limite de 100 caracteres!");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            MensagemErro::mostrarMensagem(400, "O email é invalido!");
        }
        if(strlen($senha) <= 8){
            MensagemErro::mostrarMensagem(400, "Senha inválida! Digite um senha maior que 8 caracteres!");
        }

        $nome = preg_replace('/[()=;]/', '', filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS));
        $email = htmlspecialchars($email, ENT_HTML5);
        $user = preg_replace('/[()=;]/', '', filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS));
        $senha = preg_replace('/[()=;]/', '', filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS));

        var_dump($nome);

    }
}