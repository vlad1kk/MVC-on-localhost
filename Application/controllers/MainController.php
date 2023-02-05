<?php 

namespace application\controllers;

use application\core\Controller; 
use application\lib\Db; 

class MainController extends Controller{

    public function indexAction() {

        $db = new Db;
        $db->query('SELECT name FROM users WHERE id = 1');
        
        $this->view->render('Головна сторінка');
    }

}