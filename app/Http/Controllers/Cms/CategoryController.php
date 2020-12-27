<?php

namespace App\Http\Controllers\Cms;

use App\Enums\ActionTypeEnum;
use App\Enums\CategoryEnum;
use App\Enums\Route\RouteTypeEnum;
use App\Models\Category;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Cms
 */
class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::query()->paginate(20);
        $categories->map(function ($category) {
            $category->name = CategoryEnum::getDispValue($category->name);
        });

        return view('Layouts.Cms.Pages.Category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $type = ActionTypeEnum::CREATE;

        return view('Layouts.Cms.Pages.Category.ccrud', compact('type'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $category = Category::query()->create($request->all());

        $route = [
            'type'        => RouteTypeEnum::CATEGORY,
            'name'        => $category->name,
            'category_id' => $category->id,
        ];
        Route::query()->create($route);

        return redirect('cms/category');
    }

    /**
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $type = ActionTypeEnum::VIEW;
        $products = $category->products()->paginate(20);
        $producers = $category->producers()->paginate(20);

        return view('Layouts.Cms.Pages.Category.ccrud', compact(['type', 'category', 'products', 'producers']));
    }

    /**
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $type = ActionTypeEnum::EDIT;

        return view('Layouts.Cms.Pages.Category.ccrud', compact(['type', 'category']));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect('cms/category/'.$category->id);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        if (! in_array($request->type, [ActionTypeEnum::CREATE, ActionTypeEnum::EDIT])) {
            throw new NotFoundHttpException();
        }
        $type = ActionTypeEnum::CONFIRM;
        $category = (object) $request->all();

        return view('Layouts.Cms.Pages.Category.ccrud', compact(['type', 'category']));
    }

    /**
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('cms/category');
    }
}
