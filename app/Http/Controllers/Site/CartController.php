<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CreateProductCartRequest;
use App\Repositories\Eloquents\CartEloquent;

class CartController extends Controller
{
    //
    private $cart;

    public function __construct(CartEloquent $cartEloquent)
    {
        parent::__construct();
        $this->cart = $cartEloquent;
    }

    public function list()
    {
        if (auth()->check())
            $cart = Cart::where('user_id', auth()->user()->id)->first();

        if (isset($cart) && count($cart->products) > 0)
            return view(site_vw() . '.cart.list', ['cart' => $cart]);
//        return redirect()->back();
        return view(site_vw() . '.cart.list');

    }

    public function getAuthCart()
    {
        return $this->cart->getAuthCart();
    }

    public function postProductCart(CreateProductCartRequest $request)
    {

        //dd(' hell ');
        if ($request->isJson()) {

            foreach ($request->get('data') as $row) {
                $this->cart->create($row);
            }

            return $this->cart->getAuthCart();

        }
        //dd($request->all());
        return $this->cart->create($request->all());
    }

    public function deleteCart($cart_id)
    {
        return $this->cart->delete($cart_id);
    }

    public function deleteProductCart($cart_product_id)
    {
        return $this->cart->deleteProductCart($cart_product_id);

    }
}
