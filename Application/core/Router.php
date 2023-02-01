<?php

namespace application\core;

class Router {
    protected $routes = [];
    protected $params = [];

    public function __construct(){
        $arr = require 'application/config/routes.php';
        // debug($arr);
        foreach($arr as $key => $val) {
            $this->add($key, $val);
        }
        // debug($this->routes);
    }

    // //Функція додавання маршруту:
    public function add($route, $params){
        // echo '<br>';
        // var_dump($params);
        // echo '<p>'.$route.'</p>';
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    // //Функція на перевірку маршруту:
    public function match(){
    //     //Отримуємо поточний URL:
    //     //функцією trim видаляємо "/"
        $url = trim($_SERVER['REQUEST_URI'], '/');
    //     //Перебираємо масив маршрутів:
        foreach($this->routes as $route => $params){
            // var_dump($route);
    //         //функція preg_match - виконує пошук у рядку за регулярним виразом
            if (preg_match($route, $url, $matches)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    //Функція яка буде запускати роутер:
    public function run() {
        // echo 'start';
        $this->match();
        if($this->match()){
            echo '<p>controller: <b>'.$this->params['controller'].'</b></p>';
            echo '<p>action: <b>'.$this->params['action'].'</b></p>';
        } else {
            echo 'Маршрут не знайдений';
        }
    }
}