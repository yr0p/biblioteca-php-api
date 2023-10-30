<?php
namespace src\classes;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use src\helpers\Mensagem;
use src\helpers\MensagemErro;

class Auth
{
    public function create($user)
    {
        $token = $this->generateToken($user, getenv('SECRET'));
        echo json_encode([
            "status" => 200,
            "token" => $token,
            "message" => "Usuário logado!"
        ]);
    }
    private function generateToken($user, $secret) 
    {  
        $payload = [
            "user" => $user,
            "iat" => time(),
            "exp" => time() + (60 * 60)
        ];

        $jwt = JWT::encode($payload, $secret, 'HS256');
        return $jwt;
    }
    public static function decode($token, $secret) 
    {
        try{
            $data = JWT::decode($token, new Key($secret, 'HS256'));
            return $data;
        }
        catch(\Throwable $e){
            Mensagem::mostrarMensagem(new MensagemErro, 400, "Usuário não autenticado!");
        }
        
    }
}