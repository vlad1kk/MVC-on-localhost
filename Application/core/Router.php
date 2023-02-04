<?php

namespace application\core;

use application\core\View;


class Router {
    protected $routes = [];
    protected $params = [];

    public function __construct(){
        $arr = require 'application/config/routes.php';
        foreach($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    //Функція додавання маршруту:
    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    //Функція на перевірку маршруту:
    public function match(){
        //Отримуємо поточний URL:
        //функцією trim видаляємо "/"
        $url = trim($_SERVER['REQUEST_URI'], '/');
        //Перебираємо масив маршрутів:
        foreach($this->routes as $route => $params){
    //функція preg_match - виконує пошук у рядку за регулярним виразом
            if (preg_match($route, $url, $matches)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    //Функція яка буде запускати роутер:
    public function run() {
        $this->match();
        if($this->match()){
            //ucfirst() - функція, яка перетворює перший символ рядка у верхній регістр
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            //class_exists() - функція, яка перевіряє, чи був оголошений клас
            if(class_exists($path)){
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}