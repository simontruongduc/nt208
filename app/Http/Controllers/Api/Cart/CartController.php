<?php

namespace App\Http\Controllers\Api\Cart;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Information;
use App\Models\Product;
use App\UseCases\Api\Cart\UpdateCartUseCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use League\Fractal\Manager;

/**
 * Class CartController
 *
 * @package App\Http\Controllers\Api\Cart
 */
class CartController extends ApiController
{
    /**
     * @var \App\Models\Product
     */
    protected $product;
    /**
     * CartController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     * @param \App\Models\Product $product
     */
    public function __construct(Manager $fractal, Product $product)
    {
        parent::__construct($fractal);
        $this->product = $product;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function index(Request $request)
    {
        if (Cart::query()->where('user_id', $request->user('api')->id)->count() != 0) {
            $cart = Cart::query()->where('user_id', $request->user('api')->id)->first();
            $cartProduct = CartProduct::query()->where('cart_id', $cart->id)->get();
            $cartDetail = [];
            foreach ($cartProduct as $row) {
                $product = [
                    'id'    => $row->product_id,
                    'name'  => $this->product->getProductName($row->product_id),
                    'price' => $this->product->getProductPrice($row->product_id),
                    'qty'   => $row->qty,
                ];
                array_push($cartDetail, $product);
            }

            return $this->success($cartDetail);
        }

        return $this->success();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Cart::query()->where('user_id', $request->user('api')->id)->count() == 0) {
            Cart::query()->create(['user_id' => $request->user('api')->id]);
        }
        $userCart = Cart::query()->where('user_id', $request->user('api')->id)->first();
        // đã có sp trong giỏ
        if (CartProduct::query()->where('product_id', $request->product_id)->where('cart_id', $userCart->id)->count() != 0) {
            $cartProduct = CartProduct::query()->where('product_id', $request->product_id)
                                      ->where('cart_id', $userCart->id)
                                      ->first();
            if ($this->checkQtyAddCart($request->product_id, $cartProduct->qty, $request->qty)) {
                $data = [
                    'qty' => empty($request->qty) ? $cartProduct->qty + 1 : $request->qty + $cartProduct->qty,
                ];
                CartProduct::query()->where('product_id', $request->product_id)
                           ->where('cart_id', $userCart->id)
                           ->update($data);

                return $this->success();
            }

            return $this->error(500, 'sản phẩm trong kho không đủ')->respond(500, ['x-foo' => false]);
        }
        // chưa có sp trong giỏ
        $data = [
            'cart_id'    => $userCart->id,
            'product_id' => $request->product_id,
            'qty'        => empty($request->qty) ? 1 : $request->qty,
        ];
        CartProduct::query()->create($data);

        return $this->success();
    }

    /**
     * @param $product
     * @param $productOfCartQty
     * @param $newqty
     * @return bool
     */
    public function checkQtyAddCart($product, $productOfCartQty, $newqty)
    {
        $product = Product::query()->find($product);
        $qty = empty($newqty) ? $productOfCartQty += 1 : $productOfCartQty = $newqty += $productOfCartQty;
        if ($product->qty < $qty) {
            return false;
        }

        return true;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UseCases\Api\Cart\UpdateCartUseCase $updateCartUseCase
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request, UpdateCartUseCase $updateCartUseCase)
    {
        $userCart = Cart::query()->where('user_id', $request->user('api')->id)->first();
        $product = CartProduct::query()->where('cart_id', $userCart->id)->where('product_id', $request->product_id)->first();
        switch ($request->action) {
            case '+':
                if ($this->checkQty($request->product_id, $userCart->qty, '+')) {
                    CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                        $request->product_id)->update(['qty' => $product->qty + 1]);

                    return $this->success();
                }

                return $this->error(500, 'có lỗi xẩy ra vui lòng cập nhật lại giỏ hàng trước')->respond(500,
                    ['x-foo' => false]);
                break;
            case '-':
                if ($this->checkQty($request->product_id, $userCart->qty, '-')) {
                    if ($product->qty - 1 == 0) {
                        CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                            $request->product_id)->delete();

                        return $this->success();
                    }
                    CartProduct::query()->where('cart_id', $userCart->id)->where('product_id',
                        $request->product_id)->update(['qty' => $product->qty - 1]);

                    return $this->success();
                }

                return $this->error(500, 'có lỗi xẩy ra vui lòng cập nhật lại giỏ hàng trước')->respond(500,
                    ['x-foo' => false]);
                break;
        }
    }

    /**
     * @param $product_id
     * @param $qty
     * @param $operator
     * @return bool
     */
    public function checkQty($product_id, $qty, $operator)
    {
        $product = Product::where('id', $product_id)->first();
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
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function checkout(Request $request)
    {
        $data = $this->getProductOfCart($request);
        $data += ['information' => $request->user('api')->informations];

        return $this->success($data);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function orderDetail(Request $request)
    {
        if (isset($request->information_id)) {
            $information = Information::query()->find($request->information_id);
        } else {
            $information = [
                'phone'       => $request->phone,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id'     => $request->ward_id,
                'address'     => $request->address,
            ];
        }
        $data = $this->getProductOfCart($request);
        $data['information'] = $information;

        return $this->success($data);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function delete(Request $request)
    {
        $cart = $request->user('api')->cart;
        CartProduct::where('cart_id', $cart->id)->where('product_id', $request->product_id)->delete();

        return $this->success();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Flugg\Responder\Http\Responses\ErrorResponseBuilder
     */
    public function getProductOfCart(Request $request)
    {
        $cart = Cart::where('user_id', $request->user('api')->id)->first();
        $cartProduct = CartProduct::where('cart_id', $cart['id'])->get();
        if (empty($cartProduct)) {
            return $this->error();
        }
        $cartDetail = [];
        $total = 0;
        foreach ($cartProduct as $row) {
            $product = [
                'id'    => $row->product_id,
                'name'  => $this->product->getProductName($row->product_id),
                'price' => $this->product->getSalePrice($row->product_id),
                'qty'   => $row->qty,
            ];
            $total += $this->product->getSalePrice($row->product_id) * $row->qty;
            array_push($cartDetail, $product);
        }
        $data = [
            'cart_id' => $cart['id'],
            'total'   => $total,
            'product' => $cartDetail,
        ];

        return $data;
    }
}
