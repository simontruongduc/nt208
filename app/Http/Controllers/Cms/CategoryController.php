<?php

namespace App\Http\Controllers\Cms;

use App\Enums\ActionTypeEnum;
use App\Enums\CategoryEnum;
use App\Enums\Route\RouteTypeEnum;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->paginate(20);
        $categories->map(function ($category) {
            $category->name = CategoryEnum::getDispValue($category->name);
        });

        return view('Layouts.Cms.Pages.Category.index', compact('categories'));
    }

    public function create()
    {
        $type = ActionTypeEnum::CREATE;

        return view('Layouts.Cms.Pages.Category.ccrud', compact('type'));
    }

    public function store(Request $request)
    {
        // TODO: code demo
        $data = $request->validated();
        $category = Category::query()->create($data);

        $route = [
            'type'        => RouteTypeEnum::CATEGORY,
            'key'         => $category->name,
            'category_id' => $category->id,
        ];

    }

    public function show(Category $category)
    {
        $type = ActionTypeEnum::VIEW;

        return view('Layouts.Cms.Pages.Category.ccrud', compact('type'));
    }

    public function edit(Category $category, $type)
    {
        if ($type != ActionTypeEnum::VIEW) {
            throw new NotFoundHttpException();
        }
        $type = ActionTypeEnum::EDIT;

        return view('Layouts.Cms.Pages.Category.ccrud', compact(['type', 'category']));
    }

    public function update(Request $request, Category $category)
    {
        if ($request->type != ActionTypeEnum::CONFIRM) {
            throw new NotFoundHttpException();
        }
    }

    public function confirm(Request $request)
    {
        if (! in_array($request->type, [ActionTypeEnum::CREATE, ActionTypeEnum::EDIT])) {
            throw new NotFoundHttpException();
        }
        $type = ActionTypeEnum::CONFIRM;
        $category = $request->all();

        return view('Layouts.Cms.Pages.Category.ccrud', compact(['type', 'category']));
    }

    public function destroy(Category $category, $type)
    {
        if ($type != ActionTypeEnum::VIEW) {
            throw new NotFoundHttpException();
        }
    }
}
