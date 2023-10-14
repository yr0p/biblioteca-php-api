<?php
require_once 'vendor/autoload.php';

use src\classes\URICleaner;
use src\classes\Router;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$dotenv = new Dotenv\Dotenv("src");
$dotenv->load();

$cleanURL = URICleaner::cleanURL($_SERVER['REQUEST_URI']);
$route = new Router();

// Criando as Rotas
$route->get('/index.php', 'IndexController', 'welcome');
$route->post('/register', 'UsuariosController', 'register');


// Passando as requisições
$method = $_SERVER['REQUEST_METHOD'];
$route->route($cleanURL, $method);