<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WorkController extends BaseController
{
    public function index()
    {
        $this->model = $this->model('Work');
        $eventArray = $this->model->index();

        echo json_encode($eventArray);
    }

    public function create()
    {
        $this->model = $this->model('Work');

        return $this->model->create();
    }

    public function delete()
    {
        $this->model = $this->model('Work');

        return $this->model->delete();
    }

    public function update()
    {
        $this->model = $this->model('Work');

        return $this->model->update();
    }
}
