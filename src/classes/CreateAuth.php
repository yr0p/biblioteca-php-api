<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CreateAuth{
    public static function generateToken($data, $secret) {  
        $payload = [
            "usuario" => $data["usuario"],
            "iat" => time(),
            "exp" => time() + 10
        ];

        $jwt = JWT::encode($payload, $secret, 'HS256');
        return $jwt;
    }
    public static function decode($token, $secret) {
        try{
            $data = JWT::decode($token, new Key($secret, 'HS256'));
            return $data;
        }
        catch(Throwable $e){
            return $e->getMessage();
            
        }
        
    }
}