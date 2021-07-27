<?php

namespace App\Controllers;

use App\Helpers\Widgets\UsersRegisterWidget;
use App\Models\NewsModel;
use App\Models\SettingsModel;
use App\Models\UsersModel;
use http\Env\Request;
use App\Helpers\SessionHelper;
use DateTime;

class RssController extends BaseController
{
    public function index()
    {
        return $this->render('rss/index', [
        ]);
    }

}