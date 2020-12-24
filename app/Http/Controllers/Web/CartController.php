<?php

namespace App\Http\Controllers\Web;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Flugg\Responder\Http\MakesResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use League\Fractal\Manager;

/**
 * Class CartController
 *
 * @package App\Http\Controllers\Web
 */
class CartController extends WebController
{
    use MakesResponses;

    /**
     * CartController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        parent::__construct($fractal);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cartDetail = [];
        $total = 0;
        if (Cart::query()->where('user_id', Auth::id())->count() != 0) {
            $cartDetail = $this->getCartDetail();
            $total = $this->getTotalPrice($cartDetail);
        }
        Session::start();
        Session::put('cart', ['product'     => $cartDetail,
                              'total_price' => $total,
                              'discount'    => null,
                              'coupon_code' => null,
        ]);

        return view('Layouts.Web.Pages.Cart.cart', compact('cartDetail', 'total'));
    }

    /**
     * @param $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function store($id)
    {
        if (Cart::query()->where('user_id', Auth::id())->count() == 0) {
            Cart::query()->create(['user_id' => Auth::id()]);
        }
        $userCart = Cart::query()->where('user_id', Auth::id())->first();
        // đã có sp trong giỏ
        if (CartProduct::query()->where('product_id', $id)->where('cart_id', $userCart->id)->count() != 0) {
            $cartProduct = CartProduct::query()->where('product_id', $id)
                                      ->where('cart_id', $userCart->id)
                                      ->first();
            if ($this->checkAddQty($id, $cartProduct->qty)) {
                $data = [
                    'qty' => $cartProduct->qty + 1,
                ];
                CartProduct::query()->where('product_id', $id)
                           ->where('cart_id', $userCart->id)
                           ->update($data);

                return $this->success();
            }

            return $this->error(500, 'sản phẩm trong kho không đủ')->respond(500, ['x-foo' => false]);
        }
        // chưa có sp trong giỏ
        $data = [
            'cart_id'    => $userCart->id,
            'product_id' => $id,
            'qty'        => 1,
        ];
        CartProduct::query()->create($data);
        Session::forget('cart');

        return $this->success();
    }

    /**
     * @param $product_id
     * @param $action
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function update($product_id, $action)
    {
        $userCart = Cart::query()->where('user_id', Auth::id())->first();
        $product = CartProduct::query()->where('cart_id', $userCart->id)->where('product_id', $product_id)->first();
        switch ($action) {
            case 'plus':
                if ($this->checkQty($product_id, $userCart->qty, '+')) {
                    CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                        $product_id)->update(['qty' => $product->qty + 1]);

                    return $this->success();
                }

                return $this->error(500, 'có lỗi xẩy ra vui lòng cập nhật lại giỏ hàng trước')->respond(500,
                    ['x-foo' => false]);
                break;
            case 'minus':
                if ($this->checkQty($product_id, $userCart->qty, '-')) {
                    if ($product->qty - 1 == 0) {
                        CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                            $product_id)->delete();

                        return $this->success();
                    }
                    CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                        $product_id)->update(['qty' => $product->qty - 1]);

                    return $this->success();
                }

                return $this->error(500, 'có lỗi xẩy ra vui lòng cập nhật lại giỏ hàng trước')->respond(500,
                    ['x-foo' => false]);
                break;
        }
    }

    #region [Private method]

    /**
     * @param $product_id
     * @param $qty
     * @param $operator
     * @return bool
     */
    private function checkQty($product_id, $qty, $operator)
    {
        $product = Product::query()->where('id', $product_id)->first();
        if ($operator == '+') {
            if ($product->qty - ($qty + 1) >= 0) {
                return true;
            }

            return false;
        }
        if ($product->qty - ($qty - 1) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $product
     * @param $productOfCartQty
     * @return bool
     */
    private function checkAddQty($product, $productOfCartQty)
    {
        $product = Product::query()->find($product);
        $qty = $productOfCartQty += 1;
        if ($product->qty < $qty) {
            return false;
        }

        return true;
    }
    #endregion
}
