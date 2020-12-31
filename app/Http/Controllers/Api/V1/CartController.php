<?php

namespace App\Http\Controllers\Api\V1;

use App\Cart;
use App\Http\Requests\Api\Cart\CreateProductCartRequest;
use App\Repositories\Eloquents\CartEloquent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    private $cart;

    public function __construct(CartEloquent $cartEloquent)
    {
        $this->cart = $cartEloquent;
    }

    public function postProductCart(CreateProductCartRequest $request)
    {
        if ($request->isJson()) {

            foreach ($request->get('data') as $row) {
                $this->cart->create($row);
            }

            return $this->cart->getAuthCart();

        }
        return $this->cart->create($request->all());
    }

    public function getAuthCart()
    {
        return $this->cart->getAuthCart();
    }

    public function deleteCart($cart_id)
    {
        return $this->cart->delete($cart_id);
    }

    public function deleteProductCart($cart_product_id)
    {
        return $this->cart->deleteProductCart($cart_product_id);

    }

    public function undoProductCartDelete(Request $request)
    {
        return $this->cart->undoProductCartDelete($request->all());

    }

}
