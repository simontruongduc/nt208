<?php

namespace App\Http\Controllers\Web;

use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Information;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use App\Transformers\Api\InformationTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;

class CheckOutController extends WebController
{
    /**
     * CartController constructor.
     *
     * @param \App\Models\Product $product
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Product $product,Manager $fractal)
    {
        parent::__construct($fractal);
        $this->product = $product;
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkOut()
    {
        $cart = Cart::query()->where('user_id', Auth::id())->first();
        $cartProduct = CartProduct::query()->where('cart_id', $cart->id)->get();
        $cartDetail = [];
        $total = 0;
        $provinces = Province::all();
        $information = Information::query()->where('user_id', Auth::id())->get();
        $information = fractal()->collection($information)
                                ->transformWith(new InformationTransformer())
                                ->toArray();
        foreach ($cartProduct as $row) {
            $product = Product::query()->find($row->product_id);
            $product = [
                'id'    => $row->product_id,
                'name'  => $this->product->getProductName($row->product_id),
                'price' => $this->product->getProductPrice($row->product_id),
                'qty'   => $row->qty,
            ];
            array_push($cartDetail, $product);
            $total += $row->qty * $this->product->getProductPrice($row->product_id);
        }
        $information = $information['data'];

        return view('Layouts.Web.Pages.Cart.checkout', compact('cartDetail', 'total', 'provinces', 'information'));
    }

    /**
     * @param $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function getDistrict($id)
    {
        $districts = District::query()->where('province_id', $id)->get();

        return responder()->success($districts);
    }

    /**
     * @param $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function getWard($id)
    {
        $wards = Ward::query()->where('district_id', $id)->get();

        return responder()->success($wards);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payment(Request $request)
    {
        if (isset($request->default_address_selector)) {
            $information = Information::query()->find($request->information)->first();
            $information->note = isset($request->note) ? $request->note : null;
        } else {
            $information = [
                'user_id'     => Auth::id(),
                'province_id' => $request->province,
                'district_id' => $request->district,
                'ward_id'     => $request->ward,
                'address'     => $request->address,
                'phone'       => $request->phone_number,
                'email'       => $request->email,
                'name'        => $request->first_name.' '.$request->last_name,
                'note'        => $request->note,
            ];
            $information = Information::query()->create($information);
            $information = Information::query()->find($information->id);
        }
        $cartDetail = $this->getCartDetail();
        $total = $this->getTotalPrice($cartDetail);

        return view('Layouts.Web.Pages.Cart.payment', compact('information', 'cartDetail', 'total'));
    }

    /**
     * @return array
     */
    public function getCartDetail()
    {
        $cart = Cart::query()->where('user_id', Auth::id())->first();
        $cartProduct = CartProduct::query()->where('cart_id', $cart->id)->get();
        $cartDetail = [];
        foreach ($cartProduct as $row) {
            $product = Product::query()->find($row->product_id);
            $product = [
                'id'    => $row->product_id,
                'name'  => $this->product->getProductName($row->product_id),
                'price' => $this->product->getProductPrice($row->product_id),
                'qty'   => $row->qty,
            ];
            array_push($cartDetail, $product);
        }

        return $cartDetail;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        if ($request->payment == 'cod') {
            $payment = $request->payment;
            $information = Information::query()->find($request->information)->first();
            $cartDetail = $this->getCartDetail();
            $total = $this->getTotalPrice($cartDetail);

            return view('Layouts.Web.Pages.Cart.confirm', compact('information', 'cartDetail', 'total', 'payment'));
        }
        $payment = $request->payment;
        $information = Information::query()->find($request->information)->first();
        $cartDetail = $this->getCartDetail();
        $total = $this->getTotalPrice($cartDetail);

        return view('Layouts.Web.Pages.Cart.confirm', compact('information', 'cartDetail', 'total', 'payment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function order(Request $request)
    {
        $cartDetail = $this->getCartDetail();
        $cart = Cart::query()->where('user_id', Auth::id())->first();
        $bill = [
            'user_id'        => Auth::id(),
            'information_id' => $request->information,
            'payment'        => $request->payment,
            'date_order'     => Carbon::now(),
            'total'          => $this->getTotalPrice($cartDetail),
        ];
        $bill = Bill::query()->create($bill);
        //$bill = Bill::find($bill->id);
        foreach ($cartDetail as $row) {
            $row = (object) $row;
            $bill_detail = [
                'bill_id'    => $bill->id,
                'product_id' => $row->id,
                'price'      => $row->price,
                'qty'        => $row->qty,
            ];
            CartProduct::query()->where('cart_id', $cart->id)->where('product_id', $row->id)->delete();
            Bill_detail::query()->create($bill_detail);
        }

        return redirect('/thanks');
    }

    /**
     * @param $cartProduct
     * @return float|int
     */
    public function getTotalPrice($cartProduct)
    {
        $total = 0;
        foreach ($cartProduct as $row) {
            $row = (object) $row;
            $product = Product::query()->find($row->id);
            $total += $row->qty * $this->product->getProductPrice($row->id);
        }

        return $total;
    }

    /**
     * @param $code
     */
    public function applyCouponCode($code)
    {
        $coupon = Coupon::query()->where('code', $code)->where('status', 1)->where('qty', '>', 0)->first();
        if ($coupon->count() == 1) {
            $condition = $coupon->condition;
            //if($condition->)
        }
    }
}
