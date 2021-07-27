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
class UserProductModel extends BaseModel
{
    protected $table = 'user_product';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id', 'user_id', 'product_type', 'start_date', 'end_date', 'sold_type', 'product_category_id', 'province', 'district',
        'price', 'unit', 'address', 'title', 'description', 'content', 'keyword', 'status','is_lock', 'user_name', 'user_address', 'user_phone', 'user_email'
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

    public function insert_user_product($user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district,
                                        $price, $unit, $address, $title, $description, $content, $keyword, $status, $user_name, $user_address, $user_phone, $user_email, $created_at)
    {
        $this->db->query('INSERT INTO `user_product`(user_id,product_type,start_date,end_date,sold_type,product_category_id,province,district,
             price,unit,address,title,description,content,keyword,status,user_name, user_address, user_phone, user_email,created_at)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district,
            $price, $unit, $address, $title, $description, $content, $keyword, $status, $user_name, $user_address, $user_phone, $user_email, $created_at]);

        return $this->db->insertid();
    }

    public function update_user_product($id, $user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district,
                                        $price, $unit, $address, $title, $description, $content, $keyword, $user_name, $user_address, $user_phone, $user_email)
    {
        return $this->db->query('UPDATE `user_product` SET user_id = ?,product_type = ?,start_date = ?,end_date = ?,sold_type = ?,
                                product_category_id = ?,province = ?,district = ?,price = ?,
                                unit = ?,address = ?,title = ?,description = ?,content = ?,keyword=? ,user_name=?, user_address=?, user_phone=?, user_email=?  WHERE id=?', [$user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district, $price, $unit, $address, $title, $description, $content, $keyword, $user_name, $user_address, $user_phone, $user_email, $id]);
    }
//    public function select_user_product($id){
//        return $this->db->query('SELECT user_id FROM user_product WHERE id = ? ',[$id])->getRow();
//    }
    public function select_img_user_product()
    {
        $images_db = $this->db->query('SELECT url FROM `user_media` WHERE user_product_id = ? LIMIT 1', [$this->id])->getRow();
        if ($images_db) {
            return $images_db->url;
        }
        return '';
    }

    public function select_province_user_product()
    {
        $province_db = $this->db->query('SELECT `_name` FROM sys_province WHERE id = ?', [$this->province])->getRow();
        if ($province_db) {
            return $province_db->_name;
        }
        return '';
    }

    public function select_sold_type_user_product()
    {
        $sold_type_db = $this->db->query('SELECT `title` FROM product_category WHERE id = ?', [$this->sold_type])->getRow();
        if ($sold_type_db) {
            return $sold_type_db->title;
        }
        return '';
    }

    public function select_user_id()
    {
        $user_id_db = $this->db->query('SELECT `username` FROM users WHERE id = ?', [$this->user_id])->getRow();
        if ($user_id_db) {
            return $user_id_db->username;
        }
        return '';
    }

    public function getGallery()
    {
        if (!($pk = $this->getPrimaryKey())) return null;

        return (new UserMediaModel())->where('user_product_id', $pk)->findAll();
    }
//    public function select_user_product_vip(){
//        return $this->db->query('SELECT * FROM `user_product` WHERE product_type = \'tin_vip\'')->getRow();
//    }

    public function select_count_created_at_day($user_id)
    {
        return $this->db->query('SELECT COUNT(1) as total_rec_p_day FROM user_product WHERE user_id=?
                        AND FROM_UNIXTIME(created_at,\'%Y-%m-%d\') =  DATE_FORMAT(NOW(),\'%Y-%m-%d\')', [$user_id])->getRow();
    }

    public function select_count_created_at_month($user_id)
    {
        return $this->db->query('SELECT COUNT(1) as total_rec_p_month FROM user_product WHERE user_id=?
                        AND FROM_UNIXTIME(created_at,\'%Y-%m\') =  DATE_FORMAT(NOW(),\'%Y-%m\')', [$user_id])->getRow();
    }

    public function select_district_free($district)
    {
        return $this->db->query('SELECT * FROM user_product WHERE district = ? AND product_type = \'tin_thuong\' AND`status` =1', [$district])->getResultArray();
    }

    public function select_count_province()
    {
        return $this->db->query('SELECT COUNT(id) as num FROM user_product WHERE province = 1')->getRow();
    }

    public function update_is_lock($id, $is_lock)
    {
        return $this->db->query('UPDATE user_product SET is_lock = ? WHERE id =?', [$is_lock, $id]);
    }

}


