<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\CategoryModel;

class NewsNhaDatRightBoxWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {

        $models = (new CategoryModel())
            ->where('is_lock', 0)
            ->where('parent_id', 107)
            ->orderBy('updated_at', 'DESC')
            ->findAll(5);

        if (!$models || empty($models)) return null;

        return static::render($view, 'right_box_new_nha_dat', [
            'models' => $models
        ]);
    }
}