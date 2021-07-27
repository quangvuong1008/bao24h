<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ProjectCategoryModel;

class ProjectCategory extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new ProjectCategoryModel();

        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->addQuery('like', ['title', $keyword])
                ->addQuery('orLike', ['title', StringHelper::rewrite($keyword)]);
        }

        return $this->render('index', [
            'models' => $model->getCategoryRecursive(),
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        $model = new ProjectCategoryModel();

        if ($this->isPost() && $this->validate($model->getRules())) {
            try {
                $model->loadAndSave($this->request, function ($request, array $data) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_project_category'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'validator' => $this->validator
        ]);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function update($id)
    {
        /** @var ProjectCategoryModel $model */
        $model = (new ProjectCategoryModel())->find($id);

        if (!$model) {
            return $this->renderError();
        }

        if ($this->isPost() && $this->validate($model->getRules())) {
            try {
                $model->loadAndSave($this->request, function ($request, array $data) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);

                return $this->response->redirect(route_to('admin_project_category'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'validator' => $this->validator
        ]);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var ProjectCategoryModel $model */
        if (!$this->isPost() || !($model = (new ProjectCategoryModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_project_category'));
    }

    /**
     * Upload file
     *
     * @return null|string
     */
    protected function upload()
    {
        if (($file = $this->request->getFile('image')) === null || $file->getError() || !$file->isValid()) {
            return null;
        }

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/project';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
}