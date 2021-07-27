<?php

namespace App\Controllers;

use App\Models\ProjectCategoryModel;
use App\Models\ProjectModel;
use App\Models\SettingsModel;

class Project extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $settings =  new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if($settings){
            foreach ($settings as $setting){
                $setting_array[$setting->key] = $setting->value;
            }
        }

        $categories = (new ProjectCategoryModel())
            ->where('is_lock', 0)
            ->findAll(20);

        $projects = (new ProjectModel())
            ->where('is_lock', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll(6);

        return $this->render('project/index', [
            'categories' => $categories,
            'projects' => $projects,
            'title' => $setting_array['project_meta_title'],
            'meta_image_url'=> $projects->getImage()
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function category($id)
    {
        $model = $this->findCategory($id);

        if (!$model) {
            return $this->renderError();
        }

        $projects = (new ProjectModel())
            ->where('is_lock', 0)
            ->where('category_id', $model->getPrimaryKey());

        return $this->render('category', [
            'model' => $model,
            'projects' => $projects->paginate(),
            'pager' => $projects->pager
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function detail(int $id)
    {
        /** @var ProjectModel $model */
        $model = (new ProjectModel())->where('is_lock', 0)->find($id);

        if (!$model || !($category = $this->findCategory($model->category_id))) {
            return $this->renderError();
        }

        return $this->render('detail', [
            'category' => $category,
            'model' => $model,
        ]);
    }

    public function ajaxCategory(int $id)
    {
        $this->layout = null;

        /** @var ProjectCategoryModel $model */
        $model = $this->findCategory($id);


        if (!$model) return null;

        $models = (new ProjectModel())
            ->where('is_lock', 0)
            ->where('category_id', $model->getPrimaryKey())
            ->orderBy('created_at', 'DESC')
            ->findAll(6);

        return $this->render('project/ajax-category', [
            'models' => $models
        ]);
    }

    /**
     * @param int $id
     * @return array|null|ProjectCategoryModel
     */
    protected function findCategory(int $id)
    {
        return (new ProjectCategoryModel())->where('is_lock', 0)->find($id);
    }
}