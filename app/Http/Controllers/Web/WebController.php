<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Traits\EmailTraits;
use App\Traits\UploadImageTrait;
use App\Traits\CreateTokenTraits;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;
use Flugg\Responder\Http\MakesResponses;

/**
 * Class WebController
 *
 * @package App\Http\Controllers\Web
 */
class WebController extends Controller
{
    use UploadImageTrait, MakesResponses, EmailTraits, CreateTokenTraits;

    /**
     * @var \League\Fractal\Manager
     */
    private $fractal;

    /**
     * WebController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
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
            $salePrice = $row->product->getSalePrice($row->product);
            $row->product->qty = $row->qty;
            $row->product->price = ! empty($salePrice) ? $salePrice : $row->product->price;
            $row->product->image = $row->product->images()->where('status', 1)->first()->image;
            array_push($cartDetail, $row->product);
        }

        return $cartDetail;
    }

    protected function getTotalPrice($products)
    {
        $total = 0;
        foreach ($products as $row) {
            $total += $row->qty * $row->price;
        }

        return $total;
    }
}
