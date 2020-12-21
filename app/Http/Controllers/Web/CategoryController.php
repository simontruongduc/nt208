<?php

namespace App\Http\Controllers\Web;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
use App\Sorts\ProductSort;
use App\Transformers\Web\CategoryTransformer;
use App\Transformers\Web\ProducerTransformer;
use App\Transformers\Web\ProductTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Web
 */
class CategoryController extends WebController
{
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sorts\ProductSort $productSort
     * @param \App\Filters\ProductFilter $productFilter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ProductSort $productSort, ProductFilter $productFilter)
    {
        $categories = fractal()->collection(Category::query()->orderBy('display_order', 'ASC')->get())
                               ->transformWith(new CategoryTransformer())
                               ->toArray();
        $category = $categories['data'][0]['id'];
        $products = Product::query()->where('category_id', $category)
                           ->sortBy($productSort)
                           ->filter($productFilter)
                           ->paginate(20);
        $paginate = $products->links();
        $products = fractal()->collection($products)
                             ->transformWith(new ProductTransformer())
                             ->paginateWith(new IlluminatePaginatorAdapter($products))
                             ->toArray();
        $producers = fractal()->collection(Producer::query()->take(10)->get())
                              ->transformWith(new ProducerTransformer())->toArray();
        $categories = (object) $categories['data'];
        $products = (object) $products['data'];
        $producers = (object) $producers['data'];

        return view('Layouts.Web.Pages.Product.category', compact('categories', 'products', 'paginate', 'producers'));
    }

    /**
     * @param \App\Models\Category $category
     * @param \App\Sorts\ProductSort $productSort
     * @param \App\Filters\ProductFilter $productFilter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, ProductSort $productSort, ProductFilter $productFilter)
    {
        $categories = fractal()->collection(Category::query()->orderBy('display_order', 'ASC')->get())
                               ->transformWith(new CategoryTransformer())
                               ->toArray();
        $products = Product::query()->where('category_id', $category->id)
                           ->sortBy($productSort)
                           ->filter($productFilter)
                           ->paginate(20);
        $paginate = $products->links();
        $products = fractal()->collection($products)
                             ->transformWith(new ProductTransformer())
                             ->paginateWith(new IlluminatePaginatorAdapter($products))
                             ->toArray();
        $producers = fractal()->collection(Producer::query()->take(10)->get())
                              ->transformWith(new ProducerTransformer())->toArray();
        $categories = (object) $categories['data'];
        $products = (object) $products['data'];
        $producers = (object) $producers['data'];

        return view('Layouts.Web.Pages.Product.category', compact('categories', 'products', 'paginate', 'producers'));
    }
}
