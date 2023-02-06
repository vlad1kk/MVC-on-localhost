<?php 

namespace application\controllers;

use application\core\Controller; 

class MainController extends Controller{

    public function indexAction() {
        $result = $this->model->getNews();
        debug($result);
        $this->view->render('Головна сторінка');
    }

}