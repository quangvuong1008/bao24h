<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\ProjectModel;

class NewProjectWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        return static::render($view, 'new_project', [
            'models' => (new ProjectModel())
                ->where('is_lock', 0)
                ->orderBy('created_at', 'DESC')
                ->findAll(5)
        ]);
    }
}