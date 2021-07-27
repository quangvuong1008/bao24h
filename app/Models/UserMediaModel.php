<?php

namespace App\Models;


use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;
use phpseclib\Math\BigInteger;

/**
 * Class ProjectCategoryModel
 * @package App\Models
 *
 * @property BigInteger active
 * @property string username
 * @property string password
 * @property string email
 * @property string address
 * @property string avatar
 * @property string phone
 * @property string verify_code
 */
class UserMediaModel extends BaseModel
{
    protected $table = 'user_media';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'user_product_id', 'url', 'path'
    ];
    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $skipValidation = false;
    protected $validationMessages = [];

    /**
     * @param array $data
     * @return array
     */

    /**
     * @inheritDoc
     */
    public function getRules(string $scenario = null): array
    {
        // TODO: Implement getRules() method.
        return [

        ];
    }

    public function insert_user_media($user_id, $user_product_id, $url, $path)
    {
        return $this->db->query('INSERT INTO `user_media`(user_id,user_product_id,url,path)VALUES (?,?,?,?)', [$user_id, $user_product_id, $url, $path]);
    }

    public function update_user_media($user_product_id, $url, $path)
    {
        return $this->db->query('UPDATE `user_media` SET `url` = ?,`path` = ? WHERE `user_product_id` = ?', [$url, $path, $user_product_id])->getRow();
    }

    public function select_user_media($user_product_id)
    {
        return $this->db->query('SELECT COUNT(*) as "num" FROM `user_media` WHERE user_product_id = ?', [$user_product_id])->getRow();
    }


}


