<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ObjectContentModel;
use App\Models\SliderModel;
use CodeIgniter\HTTP\Request;

class Slider extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new SliderModel();

        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->like('title', $keyword)->orLike('url', StringHelper::rewrite($keyword));
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
        /** @var SliderModel $model */
        $model = new SliderModel();

        if ($this->isPost() && $this->validate($model->getRules())) {
            try {
                $model = $model->loadAndSave($this->request, function (Request $request, array $data) use ($model) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_slider'));
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
        /** @var SliderModel $model */
        $model = (new SliderModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }

        if ($this->isPost() && $this->validate($model->getRules())) {

            try {
                $model = $model->loadAndSave($this->request, function (Request $request, array $data) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_slider'));
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
        /** @var SliderModel $model */
        if (!$this->isPost() || !($model = (new SliderModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_slider'));
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

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/slider';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
}