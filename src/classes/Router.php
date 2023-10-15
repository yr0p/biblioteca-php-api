<?php
namespace src\classes;

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
    public function route($route, $method)
    {
        foreach($this->routes as $rt){
            if($rt['route'] == $route && $rt['httpMethod'] == $method)
            {
               $this->run($rt["controller"], $rt["methodController"]);
            }
        }
    }
    public function changeDefaultRoute($route, $controller)
    {
        $this->routes[0] = [
            'method' => 'GET',
            'route' => $route,
            'controller' => $controller
        ];
    }
    private static function run($controller, $method)
    {
        $class = new \ReflectionClass('src\controllers\\' . $controller);
        $class = $class->newInstance();
        $class->$method();
    }
}
