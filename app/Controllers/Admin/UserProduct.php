<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\AdministratorModel;
use App\Models\UserProductModel;
use App\Models\UsersModel;

class UserProduct extends BaseController
{

    public function index()
    {
        $model = new UserProductModel();
        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model
                ->like('title', $keyword)
                ->orLike('sold_type', $keyword)
                ->orLike('product_type', $keyword);
        }

        $model
            ->orderBy('status', 'ASC')
        ->orderBy('id','DESC');

        return $this->render('index',[
            'models'=> $model->paginate(),
            'pager' => $model->pager
        ]);
    }

    public function view($id)
    {

        /** @var UserProductModel $model */
        $model = (new UserProductModel())->find($id);

        if (!$model) {
            return $this->renderError();
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function update($id)
    {
        $model = (new UserProductModel())->find($id);

        if (!$model) {
            return $this->renderError();
        }

        /** @var UserProductModel $model */


        $is_lock = ($_POST['is_lock']);

        $model->update_is_lock($id, $is_lock);

        $model->update($model->getPrimaryKey(), ['status' => 1]);

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
        return $this->response->redirect(route_to('admin_user_product_view', $model->getPrimaryKey()));
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var UserProductModel $model */
        if (!$this->isPost() || !($model = (new UserProductModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_user_product'));
    }

}