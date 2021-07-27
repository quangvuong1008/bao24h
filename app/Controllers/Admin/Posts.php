<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\Json;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ObjectContentModel;
use App\Models\NewsModel;
use App\Models\PostsModel;
use App\Models\PostsUrlModel;
use CodeIgniter\HTTP\Request;

class Posts extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = (new PostsModel());
        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model->orderBy('id', 'DESC')->like('title', $keyword);
        }

        $model_meta = $model->findAll();


        return $this->render('index', [
            'models' => $model->orderBy('id', 'DESC')->paginate(),
            'pager' => $model->pager,
            'model_meta'=>$model_meta
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        /** @var PostsModel $model */
        $model = new PostsModel();

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

                return $this->response->redirect(route_to('admin_posts'));
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
        /** @var PostsModel $model */
        $model = (new PostsModel())->find($id);


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

                return $this->response->redirect(route_to('admin_posts'));
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
        /** @var PostsModel $model */
        if (!$this->isPost() || !($model = (new PostsModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_posts'));
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

    //update meta posts
    public function meta($id)
    {
        if($this->isPost() && ($data = $this->request->getPost()) !== null){
            $update = (new PostsModel());
            $data = $this->request->getPost();
            $meta_title = $data['meta_title'];
            $meta_keywords = $data['meta_keywords'];
            $meta_description = $data['meta_description'];

            $post_meta = $update->update_meta($id, $meta_title, $meta_keywords, $meta_description);

            SessionHelper::getInstance()->setFlash('ALERT', [
                'type' => 'success',
                'message' => 'Cập nhật thành công'
            ]);

            return $this->response->redirect(route_to('admin_posts'));
        }else{
            $data = (new PostsModel())->find($id);
            return $this->render('posts/meta', [ 
                'model' => $data
            ]);
        }


    }


}