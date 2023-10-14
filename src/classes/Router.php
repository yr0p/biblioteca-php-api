<?php
namespace src\classes;

use src\helpers\ExecuteController;

class Router
{
    private $routes = [
        0 =>[
            'httpMethod' => 'GET',
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'welcome'
        ]
    ];

    public function add($httpMethod, $rota, $controller, $action)
    {
        array_push($this->routes, [
            'httpMethod' => $httpMethod,
            'route' => $rota,
            'controller' => $controller,
            'action' => $action
        ]);
    }
    public function get($rota, $controller, $action)
    {
        $this->add('GET', $rota, $controller, $action);
    }
    public function post($rota, $controller, $action){
        $this->add('POST', $rota, $controller, $action);
    }
    public function put($rota, $controller, $action)
    {
        $this->add('PUT', $rota, $controller, $action);
    }
    public function delete($rota, $controller, $action)
    {
        $this->add('DELETE', $rota, $controller, $action);
    }
    public function route($rota, $method)
    {
        foreach($this->routes as $route){
            if($route['route'] == $rota && $route['httpMethod'] == $method)
            {
               ExecuteController::run($route["controller"], $route["action"]);
            }
        }
    }
    public function changeDefaultRoute($rota, $controller)
    {
        $this->routes[0] = [
            'method' => 'GET',
            'route' => $rota,
            'controller' => $controller
        ];
    }
}
