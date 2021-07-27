<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\ProjectCategoryModel;

class ProjectCategoryWidget extends BaseWidget
{
    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $categories = (new ProjectCategoryModel())
            ->where('is_lock', 0)
            ->findAll(20);

        if (!$categories || empty($categories)) return null;

        return static::render($view, 'project_category', [
            'categories' => $categories
        ]);
    }
}