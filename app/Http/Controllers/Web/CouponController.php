<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\CouponUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\Fractal\Manager;

class CouponController extends WebController
{
    protected $cart;

    public function __construct(Manager $fractal, Cart $cart)
    {
        parent::__construct($fractal);
        $this->cart = $cart;
    }

    public function apply(Request $request)
    {
        $coupon = $this->checkCoupon($request->coupon);
        if (empty($coupon)) {
            return $this->error(500, 'coupon không hợp lệ hoặc không còn khả dụng vui lòng kiểm tra lại.')->respond(500,
                ['x-foo' => false]);
        }
        $cart = Session::get('cart');
        if ($coupon->condition->minimum > 0) {
            switch (true) {
                case $coupon->condition->minimum > $cart['total_price']:
                    return $this->error(500, 'Bạn chưa đủ điều kiện để sử dụng coupon này.')->respond(500,
                        ['x-foo' => false]);
                case $coupon->condition->discount == 0:
                    if ($cart['total_price'] <= $coupon->condition->maximum) {
                        $cart['discount'] = $cart['total_price'];
                    } elseif ($cart['total_price'] > $coupon->condition->maximum) {
                        $cart['discount'] = $cart['total_price'] - $coupon->condition->maximum;
                    }
                    break;
                case $coupon->condition->discount != 0:
                    if ($coupon->condition->discount * $cart['total_price'] >= $coupon->condition->discount->maximum) {
                        $cart['discount'] = $cart['total_price'];
                    } else {
                        $cart['discount'] = $cart['total_price'] - $coupon->condition->discount * $cart['total_price'];
                    }
            }
            $cart['coupon_code'] = $request->coupon;
        }
        Session::forget('cart');
        Session::put('cart', $cart);

        return $this->success($cart);
    }

    public function checkCoupon($code)
    {
        $coupon = CouponUser::query()->where('user_id', Auth::id())
                            ->whereHas('coupon', function (Builder $builder) use ($code) {
                                $today = Carbon::now();

                                return $builder->where('code', $code)->where('start_day', '>', $today)
                                               ->where('end_day', '>', $today)
                                               ->where('qty', '<', 0)
                                               ->where('status', 1);
                            })->first();

        return $coupon ? $coupon : null;
    }
}
