<?php
require_once "./CONSTANTS.php";
require_once $dir . "/classes/Routes.php";
require_once $dir . "/classes/CreateAuth.php";;
require_once $dir . "/models/Usuario.php";
class RoutesController extends Routes
{
    private $rota;
    private $dir;

    public function __construct($rota, $dir)
    {
        $this->rota = $rota;
        $this->dir = $dir;
    }

    public function redirect() 
    {
        if($this->rota == ""){
            echo "Bem vindo a API!  ";
        }
        else if($this->rota == "usuarios"){
            $data = json_decode(file_get_contents('php://input'), true);
        }
        // strlen(explode('livro/', $this->rota)[1]) == preg_match_all('/\d/', explode('livro/', $this->rota)[1])
        else if($this->rota == "livro/"){
            $headers = getallheaders();
            $data = CreateAuth::decode($headers['Authorization'], getenv('SECRET'));
            var_dump($data);
        }
        else if($this->rota == "auth"){
            $data  = json_decode(file_get_contents('php://input'), true);
            $token = CreateAuth::generateToken($data, getenv('SECRET'));
            var_dump($token);
        }
        else if($this->rota == "register"){
            $data  = json_decode(file_get_contents('php://input'), true);
            Usuario::create($data["nome"], $data["email"], $data["usuario"], $data["senha"]);
            http_response_code(200);
            echo "Usuário cadastrado!";
        }
        else{
            echo "<h1>404 - Not Found</h1>";
        }
    }
}