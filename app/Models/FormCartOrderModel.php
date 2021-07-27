<?php

namespace App\Models;

use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;

/**
 * Class FormCartOrderModel
 * @package App\Models
 *
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property string $address
 * @property int $created_at
 * @property int $quantity
 * @property int $total
 * @property int $is_done
 */
class FormCartOrderModel extends BaseModel
{
    protected $table = 'form_cart_order';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'full_name', 'email', 'note', 'address', 'phone', 'user_ip', 'is_done', 'quantity', 'total', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'full_name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|min_length[3]|max_length[255]',
            'phone' => 'required|min_length[3]|max_length[255]',
            'address' => 'required|min_length[3]|max_length[255]',
        ];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function process(array $data): bool
    {
        $this->setAttributes($data);

        $cart = SessionHelper::getInstance()->getCart();

        if (!$cart || empty($cart)) return false;

        $this->db->transBegin();
        $insertedId = null;

        try {
            $data['quantity'] = $cart['total'];
            $data['total'] = $cart['sum'];

            $insertedId = $this->insert($data);

            $stat = [];
            foreach ($cart['items'] as $productId => $item) {
                $child = new FormCartOrderItemModel();
                $res = $child->insert([
                    'cart_order_id' => $insertedId,
                    'product_id' => $productId,
                    'title' => ArrayHelper::getValue($item, ['data', 'title']),
                    'image' => ArrayHelper::getValue($item, ['data', 'image']),
                    'url' => ArrayHelper::getValue($item, ['data', 'url']),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['sum'],
                ], false);

                if (!$res) continue;

                $stat[] = true;
            }

            if (empty($stat)) {
                throw new \Exception('Không có sản phầm nào trong giỏ hàng của bạn');
            }

            $this->db->transComplete();

            // TODO: Sent email
        } catch (\Exception $ex) {
            $this->db->transRollback();
        }

        return $insertedId !== null;
    }
}