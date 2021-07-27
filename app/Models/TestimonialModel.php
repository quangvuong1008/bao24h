<?php

namespace App\Models;

use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class TestimonialModel
 * @package App\Models
 *
 * @property string $full_name
 * @property string $intro
 * @property string $image
 * @property string $url
 */
class TestimonialModel extends BaseModel implements ImageAssetInterface, UrlInterface
{
    protected $table = 'testimonial';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['full_name', 'image', 'url', 'intro', 'is_lock'];

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
            'full_name' => 'required|min_length[3]|max_length[255]',
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