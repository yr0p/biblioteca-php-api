<?php
namespace src\classes;

use src\helpers\Mensagem;
use src\helpers\MensagemErro;

class Router
{
    private $routes = [
        0 => [
            'httpMethod' => 'GET',
            'route' => '/',
            'controller' => 'IndexController',
            'methodController' => 'welcome'
        ]
    ];

    public function add($httpMethod, $rota, $controller, $methodController)
    {
        array_push($this->routes, [
            'httpMethod' => $httpMethod,
            'route' => $rota,
            'controller' => $controller,
            'methodController' => $methodController
        ]);
    }
    public function get($route, $controller, $methodController)
    {
        $this->add('GET', $route, $controller, $methodController);
    }
    public function post($route, $controller, $methodController)
    {
        $this->add('POST', $route, $controller, $methodController);
    }
    public function put($route, $controller, $methodController)
    {
        $this->add('PUT', $route, $controller, $methodController);
    }
    public function delete($route, $controller, $methodController)
    {
        $this->add('DELETE', $route, $controller, $methodController);
    }
    public function changeDefaultRoute($route, $controller)
    {
        $this->routes[0] = [
            'method' => 'GET',
            'route' => $route,
            'controller' => $controller
        ];
    }
    public function matchRoute()
    {
        $URI = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $URI = str_replace('/api.biblioteca', '', $URI);

        foreach($this->routes as $route)
        {
            $regex = str_replace('/', '\/', ltrim($route["route"], '/'));
            
            if(preg_match("/^$regex$/", ltrim($URI, '/'), $matches) && $route["httpMethod"] == $method)
            {
                $argRoute = explode('/', $route["route"]);
                $argRequest = explode('/', $matches[0]);

                $arg = array_diff($argRequest, $argRoute);
                
                return $this->run($route['controller'], $route['methodController'], $arg);
            }else if($route["route"] == $URI)
            {
                return $this->run($route["controller"], $route["methodController"]);
            }
        }

        Mensagem::mostrarMensagem(new MensagemErro, 400, "Página não encontrada!");
        
    }
    private function run($controller, $method, $arg = null)
    {
        $class = new \ReflectionClass('src\controllers\\' . $controller);
        $class = $class->newInstance();
        if($arg == null)
        {
            return $class->$method();
        }
        return $class->$method($arg);
    }
}
