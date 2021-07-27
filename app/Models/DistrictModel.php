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
class DistrictModel extends BaseModel
{
    protected $table = 'sys_district';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        '_name', '_prefix','_province_id'
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
    public function select_district_from_province($province_id){
        return $this->db->query('select * from sys_district where _province_id = ?',[$province_id])->getResultArray();
    }
    public function select_count_district($district){
        return $this->db->query('SELECT COUNT(id) AS num FROM user_product WHERE district = ?',[$district])->getRow();
    }

}


