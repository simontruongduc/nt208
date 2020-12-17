<?php

namespace App\Transformers\Api;

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
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

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
            'id'                => $product->id,
            'name'              => $product->name,
            'price'             => $product->price,
            'sale_price'        => empty($product->sales) ? $this->product->getSalePrice($product->id) : null,
            'image'             => isset($product->images) ? $product->images()
                                                                     ->where('status', 1)
                                                                     ->first()->image : null,
            'medium_score_rate' => Rate::query()->where('product_id',
                $product->id)->count() != 0 ? $this->product->getTotalRate($product->id) : null,
        ];
    }
}
