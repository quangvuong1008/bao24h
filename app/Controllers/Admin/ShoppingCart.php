<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\SessionHelper;
use App\Models\FormCartOrderItemModel;
use App\Models\FormCartOrderModel;

class ShoppingCart extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new FormCartOrderModel();

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

    /**
     * @param string $id
     * @return string
     */
    public function view($id)
    {
        /** @var FormCartOrderModel $model */
        $model = (new FormCartOrderModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }

        $items = (new FormCartOrderItemModel())->where('cart_order_id', $model->getPrimaryKey());

        return $this->render('view', [
            'model' => $model,
            'items' => $items->paginate(),
            'pager' => $items->pager
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

        /** @var FormCartOrderModel $model */
        $model = (new FormCartOrderModel())->find($id);

        if (!$model || $model->is_done == 1) {
            SessionHelper::getInstance()->setFlash('ALERT', [
                'type' => 'warning',
                'message' => 'Không tìm thấy yêu cầu hoặc đã được xử lý '
            ]);
            return $this->response->redirect($model ?
                route_to('admin_cart_view', $model->getPrimaryKey()) :
                route_to('admin_cart')
            );
        }

        $model->update($model->getPrimaryKey(), ['is_done' => 1]);

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
        return $this->response->redirect(route_to('admin_cart_view', $model->getPrimaryKey()));
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var FormCartOrderModel $model */
        if (!$this->isPost() || !($model = (new FormCartOrderModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_cart'));
    }
}