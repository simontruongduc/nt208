<?php

namespace App\Http\Controllers\Web;

use App\Enums\MessageStatusEnum;
use App\Http\Requests\Web\FeedbackRequest;
use App\Models\Message;
use App\Models\Product;
use App\Models\Sale;
use App\Transformers\Web\ProductTransformer;
use App\Transformers\Web\SaleTransformer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Web
 */
class HomeController extends WebController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::query()->orderBy(DB::raw('RAND()'))->take(20)->get();;
        $products = fractal()->collection($products)
                             ->transformWith(new ProductTransformer())
                             ->toArray();
        $deal_products = Sale::with('product')->orderBy(DB::raw('RAND()'))->take(9)->get();
        $deal_products = fractal()->collection($deal_products)
                                  ->transformWith(new SaleTransformer())
                                  ->toArray();
        $products = (object) $products['data'];
        $deal_products = (object) $deal_products['data'];

        return view('Layouts.Web.Pages.Home.index', compact('products', 'deal_products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('Layouts.Web.Pages.Other.contact');
    }

    public function sendMessage(FeedbackRequest $request)
    {
        $data = $request->validated();
        $data['status'] = MessageStatusEnum::NEW_MESSAGE;
        Message::query()->create($data);

        return view('Layouts.Web.Pages.Other.feedbackThanks');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanks()
    {
        return view('Layouts.Web.Pages.Other.thanks');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $products = Product::query()->where('name', 'like', '%'.$request->key.'%')->get();

        $products = fractal()->collection($products)
                             ->transformWith(new ProductTransformer())
                             ->toArray();
        $products = (object) $products['data'];

        return view('Layouts.Web.Pages.Other.search', compact('products'));
    }
}
