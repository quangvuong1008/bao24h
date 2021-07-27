<?php

namespace App\Models;


use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class ProjectCategoryModel
 * @package App\Models
 *
 * @property int $productId
 * @property string $title
 * @property string $image
 * @property string $ext
 */
class ProductGalleryModel extends BaseModel implements ImageAssetInterface
{
    protected $table = 'product_gallery';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['product_id', 'title', 'image', 'ext'];

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

        return base_url("uploads/product/{$this->image}");
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'min_length[3]|max_length[255]',
            'product_id' => 'required|integer',
            'image' => 'required|max_length[255]',
            'ext' => 'max_length[4]',
        ];
    }
}