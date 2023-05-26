<?php

namespace Core;

class Router {

    protected $routes = [];

    protected function add(string $method, string $uri, string $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get(string $uri, string $controller)
    {            
        $this->add('GET',$uri,$controller);
    }

    public function post(string $uri, string $controller)
    {
        $this->add('POST',$uri,$controller);
    }

    public function delete(string $uri, string $controller)
    {
        $this->add('DELETE',$uri,$controller);
    }

    public function patch(string $uri, string $controller)
    {
        $this->add('PATH',$uri,$controller);
    }

    public function put(string $uri, string $controller)
    {
        $this->add('PUT',$uri,$controller);
    }

    public function route(string $uri, string $method)
    {
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                return require base_path($route['controller']);
            }
        }
        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}

