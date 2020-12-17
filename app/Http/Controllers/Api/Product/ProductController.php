<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\ApiController;
use App\Models\Product;
use App\Transformers\Api\ProductDetailTransformer;
use App\Transformers\Api\ProductTransformer;
use App\UseCases\Api\Product\ProductDetailUseCase;
use App\UseCases\Api\Product\SearchUseCase;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers\Api\Product
 */
class ProductController extends ApiController
{
    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return $this->success(Product::query()->find($product), ProductDetailTransformer::class)->respond();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UseCases\Api\Product\SearchUseCase $searchUseCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request, SearchUseCase $searchUseCase)
    {
        $product = Product::query()->where('name', 'like', '%'.$request->key.'%')->paginate(15);

        return $this->success($product, ProductTransformer::class)->respond();
    }
}
