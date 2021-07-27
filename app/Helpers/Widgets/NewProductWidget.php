<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\ProductModel;

class NewProductWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        return static::render($view, 'new_product', [
            'models' => (new ProductModel())
                ->where('is_lock', 0)
                ->orderBy('created_at', 'DESC')
                ->findAll(5)
        ]);
    }
}