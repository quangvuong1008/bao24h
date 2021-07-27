<?php

namespace App\Controllers;


class Error extends BaseController
{
    public function code404()
    {
        return $this->render('error/error_404');
    }
}