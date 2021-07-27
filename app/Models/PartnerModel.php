<?php

namespace App\Models;

use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class PartnerModel
 * @package App\Models
 *
 * @property string $title
 * @property string $image
 * @property string $url
 */
class PartnerModel extends BaseModel implements ImageAssetInterface, UrlInterface
{
    protected $table = 'partner';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'image', 'url', 'is_lock'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['authorLog'];
    protected $beforeUpdate = ['authorLog'];

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/members/{$this->image}");
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'url' => 'max_length[255]',
            'image' => 'max_length[255]',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->url);
    }
}