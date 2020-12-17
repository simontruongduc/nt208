<?php

namespace App\Transformers\Api;

use App\Models\Product;
use League\Fractal\TransformerAbstract;
use App\Models\Category;
use App\Enums\CategoryEnum;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param \App\Models\Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'      => $category->id,
            'name'    => CategoryEnum::getDispValue($category->name),
            'product' => Product::where('category_id', $category->id)->count(),
        ];
    }
}
