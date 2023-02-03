<?php 

namespace application\core;

 class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route){
        $this->route = $route;
        $this->path = $route['controller']. '/'.$route['action'];
    }

    public function render($title, $vars =[]) {
        require 'application/views/layouts/' .$this->layout.'.php';
    }


}