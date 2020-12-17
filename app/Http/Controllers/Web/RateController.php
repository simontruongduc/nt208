<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\RateRequest;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Rate;
use App\Transformers\Web\RateTransformer;
use Illuminate\Support\Facades\Auth;

/**
 * Class RateController
 *
 * @package App\Http\Controllers\Web
 */
class RateController extends WebController
{
    /**
     * @param $productId
     * @return \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function index($productId)
    {
        $product = Product::query()->find($productId);
        if ($product) {
            $rates = $product->rates();

            return $this->success($rates, RateTransformer::class);
        }

        return $this->error(404);
    }

    /**
     * @param \App\Http\Requests\Web\RateRequest $request
     * @param $productId
     * @param null $rateId
     * @return \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function rate(RateRequest $request, $productId, $rateId = null)
    {
        if ($this->check($productId)) {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['product_id'] = $productId;
            Rate::query()->updateOrCreate($data);

            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param $productId
     * @return bool
     */
    public function check($productId)
    {
        $bills = Bill::query()->where('user_id', Auth::id())->whereHas('bill_detail', function ($query) use ($productId
        ) {
            return $query->where('product_id', $productId);
        })->count();

        return $bills ? true : false;
    }
}
