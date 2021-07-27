<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\UsersModel;
use App\Controllers\BaseController;


class LeftUserPostWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $model = new UsersModel();

        $session = session();

        $user_id = $session->get(SESSION_USER_ID_KEY);
        if($user_id){
            $model=$model->find($user_id);
        }
        return static::render($view, 'left_box_user_post', [
            'models' => $model
        ]);
    }
}