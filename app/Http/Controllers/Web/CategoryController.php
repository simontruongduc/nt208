<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = fractal()->collection(Category::query()->orderBy('display_order', 'ASC')->get())
                               ->transformWith(new CategoryTransformer())
                               ->toArray();
        $category = $categories['data'][0]['id'];
        $products = Category::query()->find($category)->products()->paginate(20);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $categories = fractal()->collection(Category::query()->orderBy('display_order', 'ASC')->get())
                               ->transformWith(new CategoryTransformer())
                               ->toArray();
        $products = $category->products()->paginate(20);
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
