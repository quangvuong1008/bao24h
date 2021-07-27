<?php

namespace App\Controllers;


use App\Helpers\Html;
use App\Models\NewsModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\RouterUrlModel;
use App\Models\SettingsModel;
use App\Models\ProductGalleryModel;
use App\Models\UserProductModel;

class Product extends BaseController
{
    /**
     * @param int $id
     * @return string
     */
    public function index(int $id)
    {
        $model = $this->findCategory($id);


        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }

        $description = '';
        $request = $this->request;
        $slug = $request->uri->getSegment(1);
        if ($slug && $slug !== ADMIN_PATH) {
            if (($config = RouterUrlModel::findBySlug($slug)) !== null) {
                $description = Html::decode($config->meta_description);
            }
        }

//        if ($id == $setting_array['home_product_block_id']) {
//
//            //get all product cate
//            $productCategories = (new ProductCategoryModel())
//                ->addQuery('where', ['is_lock', 0])
//                ->getCategoryRecursive($id, 0, 2);
//
//
//            for ($i = 0; $i < count($productCategories); $i++) {
//                $all_child_cate_id = (new ProductCategoryModel())
//                    ->getCategoryIdRecursive($productCategories[$i]->id, 0, 3);
//                $products = (new ProductModel())
//                    ->whereIn('category_id', $all_child_cate_id)
//                    ->where('is_lock', 0)
//                    ->orderBy('updated_at', 'DESC')->findAll(8);
//                $productCategories[$i]->products = $products;
//            }
//
//            //get config block id
//            $home_root_product_category_id = explode(',', $setting_array['home_root_product_category_id']);
//            //render
//            return $this->render('index_root_product', [
//                'description' => $description,
//                'model' => $model,
//                'productCategories' => $productCategories,
//                'home_root_product_category_id' => $home_root_product_category_id
//            ]);
//
//        } else {

        $all_child_cate_id = (new ProductCategoryModel())->getCategoryIdRecursive($id, 0, 3);
        $products = (new UserProductModel())
            ->whereIn('product_category_id', $all_child_cate_id)
            ->where('status', 1)
            ->where('is_lock',0)
            ->orderBy('updated_at', 'DESC');
        return $this->render('product/index', [
            'description' => $description,
            'model' => $model,
//                'productCategories'=>$productCategories,
            'products' => $products->paginate(8),
            'pager' => $products->pager
        ]);
    }


//}

    /**
     * @return string
     */
    public function category()
    {
        $categories = (new ProductCategoryModel())->where('is_lock', 0)->findAll();

        $products = (new ProductModel())
            ->where('is_lock', 0)
            ->orderBy('updated_at', 'DESC')
            ->findAll(12);

        return $this->render('product/category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function detail(int $id)
    {
        /** @var UserProductModel $model */
        $model = (new UserProductModel())->find($id);

        /** @var ProductCategoryModel $category */
        if (!$model || !($category = $this->findCategory($model->product_category_id))) {
            return $this->renderError();
        }
        $products = (new UserProductModel())
            ->where('status', 1)
            ->where('is_lock',0)
            ->where('product_category_id', $category->getPrimaryKey())
            ->whereNotIn('id', [$model->getPrimaryKey()])
            ->limit(8)
            ->orderBy('updated_at', 'DESC')
            ->findAll(8);
        $meta_info = [];
        $meta_info['title'] = $model->title;
        $meta_info['keywords'] = $model->keyword;
        $meta_info['description'] = $model->description;

        return $this->render('product/detail', [
            'category' => $category,
            'model' => $model,
            'products' => $products,
            'meta_info' => $meta_info,
        ]);
    }

    /**
     * @param int $id
     * @return array|null|ProductCategoryModel
     */
    protected function findCategory(int $id)
    {
        return (new ProductCategoryModel())->where('is_lock', 0)->find($id);
    }

}