<?php
require_once 'vendor/autoload.php';

use src\classes\URICleaner;
use src\classes\Router;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$dotenv = new Dotenv\Dotenv("src");
$route = new Router();
$cleanURL = URICleaner::cleanURL($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

// Carregando .env
$dotenv->load();

// Criando as Rotas
$route->get('/index.php', 'IndexController', 'welcome');

$route->post('/register', 'UsuariosController', 'registerUser');
$route->post('/auth', 'UsuariosController', 'login');
$route->get('/auth', 'UsuarioController', 'getUser');

$route->post('/livros', 'LivrosController', 'registerBook');
$route->get('/livros/([a-zA-Z]+-?)+', 'LivrosController', 'livros');

$route->get('/minhaBiblioteca', 'MinhaBibliotecaController', 'meusLivros');
$route->post('/minhaBiblioteca', 'MinhaBibliotecaController', 'alugar');

// Passando as requisições
$route->matchRoute();