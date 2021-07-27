<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\CategoryModel;

class NewsBiQuyetRightBoxWidget extends BaseWidget
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
            ->where('parent_id', 98)
            ->orderBy('updated_at', 'DESC')
            ->findAll(5);

        if (!$models || empty($models)) return null;

        return static::render($view, 'right_box_new_bi_quyet', [
            'models' => $models
        ]);
    }
}