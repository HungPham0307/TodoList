<?php

namespace App\Controllers;

use App\Traits\ConvertString;

class BaseController
{
    use ConvertString;

    public $uri;
    public $method;
    public $data;

    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->data = (object) ['success' => false, 'data' => null];
        $this->init();
    }

    // check function name matches with uri.if don't matches, return 404 page
    protected function init()
    {
        // exp:  todo-list -> Todolist
        $ctrl = $this->convert($this->uri[1]);

        if (!$ctrl) return $this->render('templates/404');

        // convert the first character to lowercase:
        $f = lcfirst($ctrl);

        // Verify that a value can be called as a function from the current scope
        if (is_callable([$this, $f])) return $this->$f();

        return $this->render('templates/404');
    }

    // get model to handel
    protected function model($name)
    {
        $prefix = './app/models/';

        $modelFile = $prefix . $name . '.php';
        if (!file_exists($modelFile)) return exit('Model not found!');

        require $modelFile;

        $model = '\\App\\Models\\' . $name;

        return new $model;
    }

    //render view
    protected function render($view, $data = [])
    {
        require_once "./app/views/" . $view . ".php";
    }
}
