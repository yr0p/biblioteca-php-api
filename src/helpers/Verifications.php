<?php
namespace src\helpers;

use src\helpers\Mensagem;

class Verifications
{
    public function isEmpty($data) 
    {
        if(empty($data["name"]) || empty($data["email"]) || empty($data["user"]) || empty($data["password"]) || empty($data["passwordConfirm"]))
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Por favor! Preencha seus dados.");
        }
    }
    public function charsLimite($user, $password, $passwordConfirm, $email, $name)
    {
        if((strlen($name) > 100) || (strlen($email) > 100) || (strlen($user) > 100) || (strlen($password) > 100) || (strlen($password) > 100) || strlen($passwordConfirm) > 100)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Alguns dos dados estão excedendo o limite de 100 caracteres!");
        }
    }
    public function email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Por favor! Digite um email válido.");
        }
    }
    public function password($password, $passwordConfirm = true)
    {
        if(strlen($password) <= 8 || $password != $passwordConfirm)
        {
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Dados Inválidos! User ou Password inválidos!");
        }
    }
}
