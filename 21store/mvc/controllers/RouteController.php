<?php

class RouteController
{
    private $url;
    private $route;
    private $showFooter;

    function __construct($url)
    {
        $this->url = $url;
        $this->showFooter = 1;
        self::analyseURL();
    }

    function analyseURL()
    {
        if (strcmp($this->url, "/") == 0) {
            require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . 'HomeController.php';
            $this->route = new HomeController();
            require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'home.php';
            return;
        }

        $urlArray = explode("/", $this->url);
        $controller = $urlArray[0];
        array_shift($urlArray);

        if (
            strcmp($controller, "admin") == 0
            || strcmp($controller, "add-product") == 0
            || strcmp($controller, "product-management") == 0
            || strcmp($controller, "account-management") == 0
            || strcmp($controller, "login-admin") === 0
            || strcmp($controller, "login") === 0
            || strcmp($controller, "register") === 0

        ) {
            $this->showFooter = 0;
        }

        $controller = str_replace('-', ' ', $controller);
        $controller = ucwords($controller);
        $controller = str_replace(' ', '', $controller);
        $controller .= "Controller";


        require_once ROOT . DS . 'mvc' . DS . 'controllers' . DS . $controller . '.php';
        $this->route = new $controller();
    }

    function show() {
        $this->route->render();

        if ($this->showFooter == 1) {
            $this->route->renderFooter();
        }
    }
}
