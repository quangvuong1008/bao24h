<?php

namespace App\Helpers;


use CodeIgniter\Session\Session;

class SessionHelper
{
    const CART = 'PANDA_CART';

    /** @var Session */
    public $session;

    /** @var SessionHelper */
    private static $_self;

    /**
     * @return SessionHelper
     */
    public static function &getInstance(): SessionHelper
    {
        if (static::$_self == null) {
            helper(['session']);

            static::$_self = new static();

            (static::$_self)->session = session();
        }
        return static::$_self;
    }

    /**
     * @param string $key
     * @param $data
     */
    public function setFlash(string $key, $data)
    {
        if (!$this->session) return;

        $this->session->set([$key => $data]);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasFlash(string $key): bool
    {
        if (!$this->session) return false;

        return $this->session->get($key) !== null;
    }

    /**
     * @param string $key
     * @return array|null
     */
    public function getFlash(string $key)
    {
        if (!$this->session) return null;

        $data = $this->session->get($key);

        if ($data) {
            // Destroy after get data
            $this->session->remove($key);
            return $data;
        }
        return null;
    }

    /**
     * @param string $key
     * @param $data
     */
    public function set(string $key, $data)
    {
        if (!$this->session) return;

        $this->session->set([$key => $data]);
    }

    /**
     * @param string $key
     * @return array|null
     */
    public function get(string $key)
    {
        if (!$this->session) return null;

        return $this->session->get($key);
    }

    /**
     * @param string $key
     */
    public function remove(string $key)
    {
        if (!$this->session || ($this->get($key)) === null) return;

        $this->session->remove($key);
    }

    /**
     * @param array $cart
     * @return array
     */
    protected function reCalcCart(array $cart): array
    {
        $total = 0;
        $sum = 0;
        foreach ($cart['items'] as $item) {
            $total = $total + ArrayHelper::getValue($item, 'quantity');
            $sum = $sum + ArrayHelper::getValue($item, 'sum');
        }

        ArrayHelper::setValue($cart, 'total', $total);
        ArrayHelper::setValue($cart, 'sum', $sum);

        return $cart;
    }

    /**
     * @param int $id
     * @param int $quantity
     * @return array
     */
    public function decrementFromCart(int $id, int $quantity = 1): array
    {
        $cart = $this->getCart() ?: [];

        $items = ArrayHelper::getValue($cart, 'items');

        // Item is not exists in Cart
        if (!isset($items[$id])) return $cart;

        $existQuantity = ArrayHelper::getValue($cart, ['items', $id, 'quantity'], 0);

        $newQuantity = $existQuantity - $quantity;

        if ($newQuantity <= 0) {
            // remove item from Cart
            ArrayHelper::remove($cart['items'], $id);
        } else {
            $itemSum = ArrayHelper::getValue($cart, ['items', $id, 'sum'], 0);
            $itemPrice = ArrayHelper::getValue($cart, ['items', $id, 'price'], 0);

            $newSum = $itemSum - ($itemPrice * $quantity);

            // Update new Quantity and Price
            ArrayHelper::setValue($cart, ['items', $id, 'quantity'], $newQuantity);
            ArrayHelper::setValue($cart, ['items', $id, 'sum'], $newSum);
        }

        $newCart = $this->reCalcCart($cart);

        $this->set(self::CART, $newCart);

        return $newCart;
    }

    /**
     * @param int $id
     * @param int $quantity
     * @param int $price
     * @param array $data
     * @return array
     */
    public function addToCart(int $id, int $quantity, int $price, array $data = []): array
    {
        $cart = $this->getCart() ?: [];

        if (!isset($cart['items'][$id])) {
            // Init item in cart
            $cart['items'][$id] = ['quantity' => $quantity, 'price' => $price, 'sum' => $price, 'data' => $data];
        } else {
            $itemPrice = ArrayHelper::getValue($cart, ['items', $id, 'price'], 0);
            $existQuantity = ArrayHelper::getValue($cart, ['items', $id, 'quantity'], 0);
            // Add item to Cart
            $newQuantity = $existQuantity + $quantity;
            ArrayHelper::setValue($cart, ['items', $id, 'quantity'], $newQuantity);
            ArrayHelper::setValue($cart, ['items', $id, 'sum'], $newQuantity * $itemPrice);
            // Re-Calculator item Price
        }

        $newCart = $this->reCalcCart($cart);

        $this->set(self::CART, $newCart);

        return $newCart;
    }

    /**
     * @param int $id
     * @return array
     */
    public function removeItemCart(int $id)
    {
        $cart = $this->getCart() ?: [];

        ArrayHelper::remove($cart['items'], $id);

        $newCart = $this->reCalcCart($cart);

        $this->set(self::CART, $newCart);

        return $newCart;
    }

    /**
     * @return array|null
     */
    public function getCart()
    {
        return $this->get(self::CART);
    }

    /**
     *
     */
    public function removeCart()
    {
        $this->remove(self::CART);
    }
}