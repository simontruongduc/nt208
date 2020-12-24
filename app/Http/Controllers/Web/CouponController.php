<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class CouponController extends WebController
{
    protected $cart;

    public function __construct(Manager $fractal, Cart $cart)
    {
        parent::__construct($fractal);
        $this->cart = $cart;
    }

    public function index(Request $request)
    {
        $coupon = $this->checkCoupon($request->coupon);
        if (empty($coupon)) {
            $discount = $this->getDisCount($coupon);
        }
    }

    public function checkCoupon($code)
    {
        $coupon = Coupon::query()->where('code', $code)->where('status', 1)->first();

        return $coupon ? $coupon : null;
    }
}
