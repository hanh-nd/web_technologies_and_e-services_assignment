<?php
require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . 'Controller.php';
require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . 'DefaultController.php';

class ConfirmOrderController extends DefaultController implements Controller {
	public function render(){
        require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'confirm_order.php';
    }
}
?>