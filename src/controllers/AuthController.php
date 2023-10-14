<?php
use src\interfaces\IController;

class AuthController implements IController
{
    public function generateToken()
    {
        $data  = json_decode(file_get_contents('php://input'), true);
        $token = CreateAuth::generateToken($data, getenv('SECRET'));
        var_dump($token);
    }
    public static function run()
    {

    }
}