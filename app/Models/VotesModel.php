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
class VotesModel extends BaseModel
{
    protected $table = 'votes';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'object_id', 'guest_id', 'guest_type', 'object_type', 'vote_rate', 'ip_address', 'event_type'
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

    public function get_avg_vote_rate_of_category($id)
    {
        return $this->db->query('select count(1) as total, ROUND(avg(vote_rate),1) as avg_rate from votes
                            where object_id = ? and object_type = \'category\'',[$id])->getRow();
    }
    public function insert_vote_rate($object_id,$guest_id,$vote_rate,$ip_address){
        return $this->db->query('insert into `votes`(object_id,guest_id,guest_type,object_type,vote_rate,ip_address) 
                          value (?,?,?,?,?,?) ',[$object_id,$guest_id,'anonymous','category',$vote_rate,$ip_address]);
    }
    public function get_avg_vote_rate_of_news($id){
        return $this->db->query('select count(1) as total, ROUND(avg(vote_rate),1) as avg_rate from votes
                            where object_id = ? and object_type = \'news\'',[$id])->getRow();
    }
    public function insert_vote_rate_news($object_id,$guest_id,$vote_rate,$ip_address){
        return $this->db->query('insert into `votes`(object_id,guest_id,guest_type,object_type,vote_rate,ip_address) 
                          value (?,?,?,?,?,?) ',[$object_id,$guest_id,'anonymous','news',$vote_rate,$ip_address]);
    }
}
