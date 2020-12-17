<?php

namespace App\Transformers\Api;

use App\Models\Rate;
use League\Fractal\TransformerAbstract;
use App\Models\Product;
use App\Enums\ProductStatusEnum;

class ProductDetailTransformer extends TransformerAbstract
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

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
            'category_id'       => $product->category->id,
            'producer_id'       => $product->producer->id,
            'category'          => $product->category->name,
            'producer'          => $product->producer->name,
            'name'              => $product->name,
            'price'             => $product->price,
            'sale_price'        => isset($product->sales) ? $this->product->getSalePrice($product->id) : null,
            'qty'               => $product->qty,
            'status'            => ProductStatusEnum::getDispValue($product->status),
            'introduce'         => $product->introduce->introduce,
            'medium_score_rate' => Rate::where('product_id',
                $product->id)->count() != 0 ? $this->product->getTotalRate($product->id) : null,
            'rate_detail'       => [
                '1' => $this->product->getRate($product->id, 1),
                '2' => $this->product->getRate($product->id, 2),
                '3' => $this->product->getRate($product->id, 3),
                '4' => $this->product->getRate($product->id, 4),
                '5' => $this->product->getRate($product->id, 5),
            ],
        ];
    }
}
