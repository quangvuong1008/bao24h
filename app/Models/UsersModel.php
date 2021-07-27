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
class UsersModel extends BaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username', 'password', 'email', 'address', 'avatar', 'phone', 'verify_code', 'active','is_lock', 'full_name','created_at','updated_at'
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
            'full_name' => 'required|min_length[3]|max_length[255]',
//            'username' => 'required|min_length[3]|max_length[200]',
//            'email' => 'required|integer',
        ];
    }
    public static function createPasswordHash($password): string
    {
        $options = [
            'salt' => 'your_custom_function_for_salt',
            'cost' => 12
        ];
        return password_hash($password, PASSWORD_DEFAULT, $options);
    }

    public function insert_register($username, $password, $email, $address, $full_name, $avatar, $phone,$created_at)
    {
        return $this->db->query('insert into `users`(username,password,email,address,full_name,avatar,phone,created_at) 
                          value (?,?,?,?,?,?,?,?)', [$username, $password, $email, $address, $full_name, $avatar, $phone,$created_at]);
    }

    public function select_login($username,$password){
        return $this->db->query('SELECT * FROM `users` WHERE (username=? AND password=? AND is_lock=0)',[$username,$password])->getRow();
    }
    public function select_register($username,$email){
        return $this->db->query('SELECT * FROM `users` WHERE (username=? OR email=?)',[$username,$email])->getRow();
    }
    public function update_user_information($full_name,$phone,$address,$user_id){
        return $this->db->query('UPDATE `users` SET full_name=?,phone=?,address=? WHERE id=?',
            [$full_name,$phone,$address,$user_id]);
    }
    public function update_user_password($password,$user_id){
        return $this->db->query('UPDATE `users` SET password=? WHERE id=?',[$password,$user_id]);
    }
    public function select_user_password($user_id){
        return $this->db->query('SELECT password FROM `users` WHERE  id = ?',[$user_id])->getRow();
    }

    public function get_packet_of_user($user_id){
        return $this->db->query('SELECT `number_post`,`range_type` FROM user_packet up INNER JOIN packet p ON up.packet_id = p.id 
                                        WHERE user_id = ?',[$user_id])->getRow();
    }

    public function get_count_packet_of_user($user_id){
        return $this->db->query('SELECT COUNT(id) AS count_user_product FROM user_product WHERE user_id = ? AND `status` =1',[$user_id])->getRow();
    }


}


