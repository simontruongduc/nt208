<?php

namespace App\Transformers\Web;

use App\Models\Image;
use App\Models\Rate;
use League\Fractal\TransformerAbstract;
use App\Models\Product;

class ProductTransformer extends TransformerAbstract
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
     * @param \App\Models\Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id'         => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'sale_price' => ! empty($product->sales) ? $product->getSalePrice($product) : null,
            'image'      => isset($product->images) ? $product->images()->where('status', 1)->first()->image : null,
            'route_name'  => $product->route->name,
        ];
    }
}
