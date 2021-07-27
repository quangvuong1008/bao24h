<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ObjectContentModel;
use App\Models\ProductGalleryModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\Request;

class Product extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new ProductModel();

        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->like('title', $keyword)->orLike('slug', StringHelper::rewrite($keyword));
        }

        return $this->render('index', [
            'models' => $model->paginate(),
            'pager' => $model->pager
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        /** @var ProductModel $model */
        $model = new ProductModel();

        if ($this->isPost() && $this->validate($model->getRules())) {
            $model->db->transStart();
            try {
                $model->loadAndSave($this->request, function (Request $request, array $data) use ($model) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                if (!$model) {
                    throw new \Exception('Đã có lỗi xảy ra, hãy thử lại');
                }

                $gallery = $this->uploadMultiple();
                if (!empty($gallery)) {
                    $model->saveGallery($gallery);
                }

                $model->db->transComplete();

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_product'));
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
        /** @var ProductModel $model */
        $model = (new ProductModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }

        if ($this->isPost() && $this->validate($model->getRules())) {
            $model->db->transStart();
            try {
                $model = $model->loadAndSave($this->request, function (Request $request, array $data) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                if (!$model) {
                    throw new \Exception('Đã có lỗi xảy ra, hãy thử lại');
                }

                $gallery = $this->uploadMultiple();
                if (!empty($gallery)) {
                    $model->saveGallery($gallery);
                }

                $model->db->transComplete();

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);

                return $this->response->redirect(route_to('admin_product'));
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
     * @return bool|mixed
     * @throws \Exception
     */
    public function removeContent($id)
    {
        if (!$this->request->isAJAX() || !$this->isPost()) return false;

        /** @var ObjectContentModel $model */
        $model = (new ObjectContentModel())->find($id);

        if (!$model) {
            throw new \Exception('Không tìm thấy nội dung');
        }

        return $model->delete($model->getPrimaryKey());
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var ProductModel $model */
        if (!$this->isPost() || !($model = (new ProductModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_product'));
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

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/product';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }

    /**
     * Upload Gallery
     *
     * @return array
     */
    protected function uploadMultiple()
    {
        $files = $this->request->getFiles();

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/product';

        $images = [];
        /** @var UploadedFile[] $gallery */
        if ($files && ($gallery = ArrayHelper::getValue($files, 'gallery')) !== null) {
            foreach ($gallery as $file) {
                if ($file->getError() || !$file->isValid()) continue;

                $fileName = $file->getFileNameStore();

                if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
                    $images[] = ['image' => $fileName, 'ext' => $file->getExtension()];
                }

            }
        }

        return $images;
    }
}