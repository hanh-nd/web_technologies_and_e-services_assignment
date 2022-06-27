<?php
class DefaultController {
    public function __header() {

    }
    
    public function __footer(){
        include ROOT . DS . 'mvc' . DS . 'views' . DS . 'footer.php';
    }
}