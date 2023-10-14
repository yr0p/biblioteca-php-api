<?php
namespace src\classes;

class Router
{
    private $routes = [
        0 =>[
            'method' => 'GET',
            'route' => '/',
            'controller' => 'IndexController'
        ]
    ];

    public function add($method, $rota, $controller)
    {
        array_push($this->routes, [
            'method' => $method,
            'route' => $rota,
            'controller' => $controller
        ]);
    }
    public function get($rota, $controller)
    {
        $this->add('GET', $rota, $controller);
    }
    public function post($rota, $controller){
        $this->add('POST', $rota, $controller);
    }
    public function put($rota, $controller)
    {
        $this->add('PUT', $rota, $controller);
    }
    public function delete($rota, $controller)
    {
        $this->add('DELETE', $rota, $controller);
    }
    public function route($rota, $method)
    {
        foreach($this->routes as $route){
            if($route['route'] == $rota && $route['method'] == $method)
            {
                include_once './src/controllers/'. $route['controller'] . '.php';
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
