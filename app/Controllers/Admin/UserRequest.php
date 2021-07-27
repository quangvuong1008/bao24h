<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\SessionHelper;
use App\Models\FormRequestModel;

class UserRequest extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new FormRequestModel();

        // Filter By keyword
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model
                ->like('full_name', $keyword)
                ->orLike('phone', $keyword)
                ->orLike('email', $keyword);
        }

        $model->orderBy('id', 'DESC');

        return $this->render('index', [
            'models' => $model->paginate(),
            'pager' => $model->pager
        ]);
    }

    public function view($id)
    {
        /** @var FormRequestModel $model */
        $model = (new FormRequestModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     * @throws \ReflectionException
     */
    public function update($id)
    {
        if (!$this->isPost()) {
            return $this->renderError();
        }

        /** @var FormRequestModel $model */
        $model = (new FormRequestModel())->find($id);

        if (!$model || $model->is_done == 1) {
            SessionHelper::getInstance()->setFlash('ALERT', [
                'type' => 'warning',
                'message' => 'Không tìm thấy yêu cầu hoặc đã được xử lý '
            ]);
            return $this->response->redirect($model ?
                route_to('admin_user_request_view', $model->getPrimaryKey()) :
                route_to('admin_user_request')
            );
        }

        $model->update($model->getPrimaryKey(), ['is_done' => 1]);

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
        return $this->response->redirect(route_to('admin_user_request_view', $model->getPrimaryKey()));
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var FormRequestModel $model */
        if (!$this->isPost() || !($model = (new FormRequestModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_user_request'));
    }
}