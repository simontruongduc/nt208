<?php

namespace App\Transformers\Web;

use App\Enums\ProductStatusEnum;
use App\Models\Rate;
use League\Fractal\TransformerAbstract;
use App\Models\Product;

class ProductDetailTransformer extends TransformerAbstract
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
            'id'                => $product->id,
            'name'              => $product->name,
            'price'             => $product->price,
            'sale_price'        => ! empty($product->sales) ? $product->getSalePrice($product) : null,
            'qty'               => $product->qty,
            'status'            => ProductStatusEnum::getDispValue($product->status),
            'producer'          => $product->producer->name,
            'short_introduce'   => $product->introduce->short_introduce,
            'introduce'         => $product->introduce->introduce,
            'image'             => $product->images()->where('status', 1)->first()->image,
            'medium_score_rate' => Rate::query()->where('product_id',
                $product->id)->count() != 0 ? $product->getTotalRate($product->id) : null,
            'reviews'           => Rate::query()->where('product_id', $product->id)->count(),
            'rate_detail'       => [
                '1' => $product->getRate($product->id, 1),
                '2' => $product->getRate($product->id, 2),
                '3' => $product->getRate($product->id, 3),
                '4' => $product->getRate($product->id, 4),
                '5' => $product->getRate($product->id, 5),
            ],
        ];
    }
}
