<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class NewsModel
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $image
 * @property string $intro
 * @property int $is_hot
 * @property int $is_lock
 */
class SettingsModel extends BaseModel
{
    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['key', 'value'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;



    public function get_setting($key){
        if($key){
            return $this->where('key',$key)->first();
        }
        return null;
    }


    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [

        ];
    }

    public function insert_or_update($key = '', $value=''){
        $config = $this->where('key', $key)->first();
        if($config){
            $this->update($config->id,['value' => $value]);
        }else{
            $this->insert(['key'=> $key, 'value' => $value]);
        }
    }



}