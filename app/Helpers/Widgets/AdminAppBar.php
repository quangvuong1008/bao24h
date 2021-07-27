<?php

namespace App\Helpers\Widgets;


use App\Helpers\ArrayHelper;
use App\Libraries\BaseView;
use App\Models\AdministratorModel;
use CodeIgniter\HTTP\IncomingRequest;

class AdminAppBar extends BaseWidget
{
    private static $items = [

    ];

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $identity = AdministratorModel::findIdentity();

        /** @var IncomingRequest $request */
        $request = service('request');

        $controllerName = $request->uri->getSegment(2);
        $controllerName = $controllerName ? str_replace('-','_', $controllerName) : null;

        $formAction = $controllerName ? route_to('admin_' . $controllerName) :null;

        return static::render($view, 'admin_app_bar', ArrayHelper::merge($data, [
            'identity' => $identity,
            'formAction' => $formAction,
            'keyword' => $request->getGet('keyword')
        ]));
    }
}