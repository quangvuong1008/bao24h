<?php

namespace App\Controllers;


use App\Helpers\Html;
use App\Helpers\Json;
use App\Helpers\SessionHelper;
use App\Models\FormCartOrderModel;
use App\Models\ProductModel;

class ShoppingCart extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            return Json::encode(SessionHelper::getInstance()->getCart());
        }

        $cart = SessionHelper::getInstance()->getCart();


        return $this->render('cart/index', [
            'cart' => $cart
        ]);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function checkout()
    {
        $cart = SessionHelper::getInstance()->getCart();

        if (!$cart || empty($cart)) {
            return $this->render('cart/empty');
        }

        $model = new FormCartOrderModel();

        if ($this->isPost() && $this->validate($model->getRules()) && ($data = $this->request->getPost())) {
            $data['user_ip'] = $this->request->getIPAddress();

            if ($model->process($data)) {
                //
                SessionHelper::getInstance()->removeCart();
                //
                SessionHelper::getInstance()->setFlash('GLOBAL', [
                    'type' => 'SUCCESS',
                    'message' => 'Tạo đơn hàng thành công.'
                ]);
                return $this->response->redirect('/');
            }
            SessionHelper::getInstance()->setFlash('GLOBAL', [
                'type' => 'DANGER',
                'message' => 'Đã có lỗi xảy ra khi tạo đơn hàng, hãy thử lại.'
            ]);
        }

        return $this->render('cart/checkout', [
            'cart' => $cart,
            'model' => $model
        ]);
    }

    /**
     * @return null|string
     */
    public function add()
    {
        if (!$this->request->isAJAX()) return $this->renderError();

        $id = $this->request->getPost('id');

        $quantity = $this->request->getPost('quantity') || 1;

        /** @var ProductModel $model */
        $model = (new ProductModel())->where('is_lock', 0)->find($id);

        if (!$model) return null;

        $response = SessionHelper::getInstance()->addToCart($model->getPrimaryKey(), $quantity, $model->price ?: 0, [
            'title' => Html::decode($model->title),
            'image' => $model->getImage(),
            'url' => $model->getUrl()
        ]);

        return Json::encode($response);
    }

    /**
     * @return null|string
     */
    public function decrement()
    {
        if (!$this->request->isAJAX()) return $this->renderError();

        $id = $this->request->getPost('id');

        $quantity = $this->request->getPost('quantity') || 1;

        /** @var ProductModel $model */
        $model = (new ProductModel())->where('is_lock', 0)->find($id);

        if (!$model) return null;

        $response = SessionHelper::getInstance()->decrementFromCart($model->getPrimaryKey(), $quantity);

        return Json::encode($response);
    }

    public function remove()
    {
        if (!$this->request->isAJAX()) return $this->renderError();

        $id = $this->request->getPost('id');

        $response = SessionHelper::getInstance()->removeItemCart($id);

        return Json::encode($response);
    }
}