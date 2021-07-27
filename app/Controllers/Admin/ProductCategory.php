<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ProductCategoryModel;
use App\Models\CategoryModel;

/**
 * Class ProductCategory
 * @package App\Controllers\Admin
 */
class ProductCategory extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new ProductCategoryModel();

        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->like('title', $keyword)->orLike('slug', StringHelper::rewrite($keyword));
        }

//        return $this->render('index', [
//            'models' => $model->paginate(),
//            'pager' => $model->pager
//        ]);

        return $this->render('index', [
            'models' => $model->getCategoryRecursive(),
//            'pager' => $model->pager
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        $model = new ProductCategoryModel();



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

                return $this->response->redirect(route_to('admin_product_category'));
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
        /** @var ProductCategoryModel $model */
        $model = (new ProductCategoryModel())->find($id);

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

                return $this->response->redirect(route_to('admin_product_category'));
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
        /** @var ProductCategoryModel $model */
        if (!$this->isPost() || !($model = (new ProductCategoryModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_product_category'));
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

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/category';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
}