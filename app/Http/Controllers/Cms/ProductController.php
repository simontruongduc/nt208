<?php

namespace App\Http\Controllers\Cms;

use App\Enums\Route\RouteTypeEnum;
use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()->paginate(20);
        return view('Layouts.Cms.Pages.Product.index',compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // TODO: code demo
        $data = $request->validated();
        $category = Product::query()->create($data);

        $route = [
            'type'        => RouteTypeEnum::CATEGORY,
            'key'         => $category->name,
            'category_id' => $category->id,
        ];

    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
