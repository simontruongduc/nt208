<?php

namespace App\Transformers\Web;

use App\Models\Product;
use League\Fractal\TransformerAbstract;
use App\Models\Sale;

class SaleTransformer extends TransformerAbstract
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
     * @param \App\Models\Sale $sale
     * @return array
     */
    public function transform(Sale $sale)
    {
        $product = new Product();

        return [
            'id'         => $sale->product->id,
            'name'       => $sale->product->name,
            'price'      => $sale->product->price,
            'sale_price' => $product->getSalePrice($sale->product->id),
            'image'      => $sale->product->images()->where('status', 1)->first()->image,
            'route_name' => $sale->product->route->name,
        ];
    }
}
