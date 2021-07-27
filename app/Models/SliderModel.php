<?php

namespace App\Models;

use App\Models\Interfaces\ImageAssetInterface;

/**
 * Class SliderModel
 * @package App\Models
 *
 * @property string $title
 * @property string $image
 * @property string $url
 * @property int $is_lock
 */
class SliderModel extends BaseModel implements ImageAssetInterface
{
    protected $table = 'home_slider';
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
     * @return null|string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/slider/{$this->image}");
    }
}