<?php
require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . 'Controller.php';
require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . 'DefaultController.php';

class DetailController extends DefaultController implements Controller{
    public function render(){
        require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'detail_product.php';
    }
}