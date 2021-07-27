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
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $intro
 * @property string $short_intro
 * @property string $content
 * @property string $image
 * @property string $material
 * @property string $guarantee
 * @property int $price
 * @property int $discount
 * @property int $is_lock
 */
class ProductModel extends BaseModel implements ImageAssetInterface, UrlInterface
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'title', 'slug', 'image', 'intro', 'short_intro', 'content', 'category_id', 'price', 'discount', 'is_lock',
        'material', 'guarantee'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['updateSlug', 'authorLog'];
    protected $beforeUpdate = ['updateSlug', 'authorLog'];


    protected $frontendRouter = 'Product::detail';
    protected $afterInsert = ['instanceUrl'];
    protected $afterUpdate = ['instanceUrl'];
    protected $afterDelete = ['removeUrl'];

    /**
     * @param array $data
     * @return array
     */
    public function updateSlug(array $data): array
    {
        if (!isset($data['data']['slug']) || empty($data['data']['slug'])) {
            // Create 'slug' if not exists
            $data['data']['slug'] = $data['data']['title'];
        }
        $data['data']['slug'] = StringHelper::rewrite($data['data']['slug']);
        return $data;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/product/{$this->image}");
    }

    /**
     * @return mixed
     */
    public function getCategoryOptions()
    {
        return (new ProductCategoryModel())->getCategoryOptions();
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'slug' => 'max_length[255]',
            'category_id' => 'required|integer',
            'material' => 'max_length[255]',
            'guarantee' => 'max_length[255]',
            'image' => 'max_length[255]',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->slug);
    }

    /**
     * @param array $gallery
     * @throws \ReflectionException
     */
    public function saveGallery(array $gallery)
    {
        if (!($pk = $this->getPrimaryKey())) return;

        foreach ($gallery as $image) {
            $model = new ProductGalleryModel();
            $image['product_id'] = $pk;
            if (!$model->save($image)) continue;
        }
    }

    /**
     * @return ProductGalleryModel[]|null
     */
    public function getGallery()
    {
        if (!($pk = $this->getPrimaryKey())) return null;

        return (new ProductGalleryModel())->where('product_id', $pk)->findAll();
    }
}