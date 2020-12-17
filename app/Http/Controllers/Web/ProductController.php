<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Transformers\Web\ProductDetailTransformer;
use App\Transformers\Web\ProductTransformer;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers\Web
 */
class ProductController extends WebController
{
    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        $productTransform = new ProductDetailTransformer();
        $suggestions = Product::query()->where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->take('4')
                              ->get();
        $suggestions = fractal()->collection($suggestions)
                                ->transformWith(new ProductTransformer())
                                ->toArray();
        $product = $productTransform->transform($product);
        $product = (object) $product;
        $suggestions = (object) $suggestions['data'];

        return view('Layouts.Web.Pages.Product.detail', compact('product', 'suggestions'));
    }
}
