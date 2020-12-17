<?php

namespace App\Transformers\Web;

use App\Enums\CategoryEnum;
use App\Models\Product;
use League\Fractal\TransformerAbstract;
use App\Models\Category;

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
            'id'        => $category->id,
            'name'      => CategoryEnum::getDispValue($category->name),
            'product'   => Product::query()->where('category_id', $category->id)->count(),
            'route_name' => $category->route->name,
        ];
    }
}
