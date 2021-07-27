<?php

namespace App\Controllers;


use App\Models\ContentModel;

class Content extends BaseController
{
    /**
     * @param int $id
     * @return string
     */
    public function detail(int $id)
    {
        $model = (new ContentModel())->where('is_lock', 0)->find($id);

        if (!$model) {
            return $this->renderError();
        }

        return $this->render('detail', [
            'model' => $model
        ]);
    }
}