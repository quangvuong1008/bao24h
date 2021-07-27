<?php

namespace App\Models;


use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;
use phpseclib\Math\BigInteger;

/**
 * Class ProjectCategoryModel
 * @package App\Models
 *
 * @property BigInteger object_id
 * @property string guest_id
 * @property string guest_type
 * @property string object_type
 * @property string vote_rate
 * @property string ip_address
 * @property string event_type
 */
class UserPacketModel extends BaseModel
{
    protected $table = 'user_packet';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id','user_id','packet_id'
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

    public function select_user_packet(){
        $packet_db = $this->db->query('SELECT `name` FROM packet WHERE id = ?', [$this->packet_id])->getRow();
        if ($packet_db) {
            return $packet_db->name;
        }
        return '';
    }
    public function insert_user_packet($user_id,$packet_id){
        return $this->db->query('INSERT INTO `user_packet`(user_id , packet_id) VALUES (?,?)',[$user_id,$packet_id]);
    }
    public function delete_user_packet($user_id){
        return $this->db->query('DELETE FROM user_packet WHERE user_id = ?',[$user_id]);
    }

    public function get_user_packet($user_id){
        return $this->db->query('SELECT packet_id FROM user_packet WHERE user_id = ?',[$user_id])->getRow();
    }
    public function select_name_packet($user_id){
        return $this->db->query('SELECT pk.name FROM packet pk JOIN user_packet upk ON upk.packet_id= pk.id WHERE user_id = ?',[$user_id])->getRow();
    }

}
