<?php

namespace App\Models;

/**
 * Class FormCartOrderModel
 * @package App\Models
 *
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property string $address
 * @property string $title
 * @property string $image
 * @property string $url
 * @property int $product_id
 * @property int $quantity
 * @property int $price
 * @property int $total
 */
class FormCartOrderItemModel extends BaseModel
{
    protected $table = 'form_cart_order_item';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'cart_order_id', 'product_id', 'quantity', 'price', 'total', 'title', 'image', 'url'
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
        return [];
    }
}