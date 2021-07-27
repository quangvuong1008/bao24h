<?php

namespace App\Controllers;

use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use CodeIgniter\Controller;

class Notification extends Controller
{
    public function alert()
    {
        if (!($data = SessionHelper::getInstance()->getFlash('ALERT'))) return null;

        $color = ArrayHelper::getValue($data, 'type');
        $message = ArrayHelper::getValue($data, 'message');
        $js = <<<JS
$.notify({icon: 'add_alert', message: "$message"}, {type: "$color", placement: {from: 'bottom', align: 'right'}});
JS;
        return $js;
    }
}