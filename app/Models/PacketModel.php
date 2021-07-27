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
class PacketModel extends BaseModel
{
    protected $table = 'packet';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id','name','number_post','range_type'
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
            'name' => 'required|min_length[2]|max_length[255]',
        ];
    }
    public function get_user_packet_id($user_id){
        return $this->db->query('SELECT packet_id FROM user_packet WHERE user_id = ?',[$user_id])->getRow();
    }

}
