<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
//        $this->layout = 'empty';

        return $this->render('index');
    }
}