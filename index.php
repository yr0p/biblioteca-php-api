<?php
require_once 'vendor/autoload.php';

use src\classes\URICleaner;
use src\classes\Router;

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *'); // Ou substitua * pelo domínio permitido
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Inclua todos os métodos suportados
    header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Inclua todos os cabeçalhos necessários

    // Encerre a execução do script PHP para evitar que o código principal seja executado
    exit;
}

header('Access-Control-Allow-Origin: *');
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

$route->post('/user', 'UsuariosController', 'userDecode');
$route->get('/user', 'UsuariosController', 'getUser');
$route->put('/user', 'UsuariosController', 'updateUser');
$route->delete('/user', 'UsuariosController', 'deleteUser');

$route->post('/registerBook', 'LivrosController', 'registerBook');
$route->get('/livros', 'LivrosController', 'verLivros');
$route->put('/livros', 'LivrosController', 'updateBook');
$route->get('/livros/([a-zA-Z]+-?)+', 'LivrosController', 'livros');
$route->delete('/livros/([a-zA-Z]+-?)+', 'LivrosController', 'deleteBook');

$route->get('/minhaBiblioteca', 'MinhaBibliotecaController', 'meusLivros');
$route->post('/minhaBiblioteca', 'MinhaBibliotecaController', 'reservar');
$route->get('/minhaBiblioteca/([a-zA-Z]+-?)+', 'MinhaBibliotecaController', 'filterBy');
$route->delete('/minhaBiblioteca', 'MinhaBibliotecaController', 'deleteBook');


// Passando as requisições
$route->matchRoute();