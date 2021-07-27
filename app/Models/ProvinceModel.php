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
class ProvinceModel extends BaseModel
{
    protected $table = 'sys_province';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        '_name', '_code'
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


}


