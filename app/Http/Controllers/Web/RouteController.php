<?php

namespace App\Http\Controllers\Web;

use App\Enums\CategoryEnum;
use App\Enums\Route\RouteTypeEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Route;
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

    public function match($type, $key)
    {
        if (in_array($type, RouteTypeEnum::toArray())) {
            return $this->redirect($type, $key);
        }
        throw new NotFoundHttpException();
    }

    private function redirect($type, $key)
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

                return $action->show(Category::query()->find($route->category_id));
        }
    }
}
