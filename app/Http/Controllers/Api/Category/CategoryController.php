<?php

namespace App\Http\Controllers\Api\Category;

use App\Models\Category;
use App\Transformers\Api\CategoryTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\UseCases\Api\Category\CategoriesUseCase;
use App\UseCases\Api\Category\ProductsOfCategoryUseCase;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Api\Category
 */
class CategoryController extends ApiController
{
    /**
     * @param \App\UseCases\Api\Category\CategoriesUseCase $categoriesUseCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CategoriesUseCase $categoriesUseCase)
    {
        return $this->success(Category::all(), CategoryTransformer::class)->respond();
    }

    /**
     * @param $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsOfCategory($category)
    {
        $showProductOfCategoryUseCase = new ProductsOfCategoryUseCase();

        return $showProductOfCategoryUseCase->invoke($category);
    }
}
