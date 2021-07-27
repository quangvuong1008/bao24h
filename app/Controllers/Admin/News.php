<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\Json;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ObjectContentModel;
use App\Models\NewsModel;
use CodeIgniter\HTTP\Request;

class News extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new NewsModel();
        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->orderBy('id','DESC')->like('title', $keyword)->orLike('slug', StringHelper::rewrite($keyword));
        }

        return $this->render('index', [
            'models' => $model->orderBy('id','DESC')->paginate(),
            'pager' => $model->pager
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        /** @var NewsModel $model */
        $model = new NewsModel();

        if ($this->request->isAJAX()) {
            return Json::encode($model->getContents());
        }

        if ($this->isPost() && $this->validate($model->getRules())) {
            $model->db->transBegin();
            try {
                $model = $model->loadAndSave($this->request, function (Request $request, array $data) use ($model) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                if (!$model) {
                    throw new \Exception('Đã có lỗi xảy ra, hãy thử lại');
                }

                if (($contents = ArrayHelper::getValue($this->request->getPost(), 'contents')) &&
                    !empty($contents)) {
                    $model->saveContents($contents);
                }

                $model->db->transComplete();

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_news'));
            } catch (\Exception $ex) {
                $model->db->transRollback();
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
        /** @var NewsModel $model */
        $model = (new NewsModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }

        if ($this->request->isAJAX()) {
            return Json::encode($model->getContents());
        }

        if ($this->isPost() && $this->validate($model->getRules())) {
            $model->db->transBegin();
            try {
                $model = $model->loadAndSave($this->request, function (Request $request, array $data) use ($model) {
                    if (($image = $this->upload()) !== null) {
                        $data['image'] = $image;
                    }
                    return $data;
                });

                if (!$model) {
                    throw new \Exception('Đã có lỗi xảy ra, hãy thử lại');
                }

                if (($contents = ArrayHelper::getValue($this->request->getPost(), 'contents')) &&
                    !empty($contents)) {
                    $model->saveContents($contents);
                }

                $model->db->transComplete();

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_news'));
            } catch (\Exception $ex) {
                $model->db->transRollback();
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
        /** @var NewsModel $model */
        if (!$this->isPost() || !($model = (new NewsModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_news'));
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

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/content';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
}