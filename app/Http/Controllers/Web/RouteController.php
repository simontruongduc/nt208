<?php

namespace App\Http\Controllers\Web;

use App\Enums\CategoryEnum;
use App\Enums\Route\RouteTypeEnum;
use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\Route;
use App\Sorts\ProductSort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteController extends WebController
{
    private $url;

    private $fractal;

    public function __construct(Manager $fractal)
    {
        parent::__construct($fractal);
        $this->fractal = $fractal;
    }

    public function match($type, $key, Request $request)
    {
        if (in_array($type, RouteTypeEnum::toArray())) {
            return $this->redirect($type, $key, $request);
        }
        throw new NotFoundHttpException();
    }

    private function redirect($type, $key, Request $request)
    {
        $route = Route::query()->where('name', $key)
                      ->where('type', $type)->first();
        if (! $route) {
            throw new NotFoundHttpException();
        }
        switch ($type) {
            case RouteTypeEnum::PRODUCT:
                $action = new ProductController($this->fractal);

                return $action->show(Product::query()->find($route->product_id));
            case RouteTypeEnum::CATEGORY:
                $action = new CategoryController($this->fractal);
                $sort = new ProductSort($request);
                $filter = new ProductFilter($request);

                return $action->show(Category::query()
                                             ->find($route->category_id), $sort, $filter);
        }
    }
}
