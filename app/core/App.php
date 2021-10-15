<?php

namespace App\Core;

use App\Traits\ConvertString;

require './app/controllers/BaseController.php';

class App
{
    use ConvertString;

    public function __construct()
    {
        $this->uri = $this->convertUri();
        $this->handleController();
    }

    // get controller name and function name
    private function convertUri()
    {
        $uri = preg_replace('/\/+/', '/', trim(str_replace('.', '-', parse_url(getenv('REQUEST_URI') ?? "home", PHP_URL_PATH)), '/'));
        $uri = $uri ? explode('/', $uri) : ['home', 'index'];
        if (count($uri) == 1) $uri[] = 'index';

        return $uri;
    }

    // required controller and initialize class controller
    private function handleController()
    {
        $prefix = './app/controllers/';
        $class = '\\App\\Controllers\\';

        // if not exist uri[0], return Home
        $controller = $this->convert($this->uri[0], 'Home');

        $controllerFile = $prefix . $controller . 'Controller.php';
        if (!file_exists($controllerFile)) {
            $controllerFile = $prefix . 'HomeController.php';
        }

        require $controllerFile;

        $controllerName = $class . $controller . 'Controller';
        if (!class_exists($controllerName)) {
            $controllerName = $class . 'HomeController';
        }

        return new $controllerName($this->uri);
    }
}
