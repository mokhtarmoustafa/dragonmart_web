<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Cart;
use App\CartProduct;
use App\CartProductCustom;
use App\Product;
use App\ProductCustomization;
use App\Repositories\Interfaces\Repository;
use App\User;

class CartEloquent implements Repository
{

    private $model, $product, $user;

    public function __construct(Cart $model, Product $product, User $user)
    {
        $this->model = $model;
        $this->product = $product;
        $this->user = $user;
    }

    // for cpanel
    function anyData()
    {
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }


    function getById($id)
    {
        $cart = $this->model->find($id);

        if (isset($cart)) {
            return response_api(true, 200, null, $cart);
        }
        return response_api(false, 422);
    }


    function getAuthCart()
    {

        $cart = $this->model->where('user_id', auth()->user()->id)->first();
        if (isset($cart)) {

            $merchant_ids = CartProduct::where('cart_id', $cart->id)->where('status', 'pending')->pluck('merchant_id')->unique();
            $merchants = $this->user->whereIn('id', $merchant_ids)->get();


            foreach ($merchants as $merchant) {
                $merchant['products_cart'] = CartProduct::where('cart_id', $cart->id)->where('merchant_id', $merchant->id)->where('status', 'pending')->get();
            }

            return response_api(true, 200, null, $merchants);
        }
        return response_api(true, 200, null, []);
    }

    function create(array $attributes)
    {
        $product = $this->product->find($attributes['product_id']);

        if ($product->available_quantity >= $attributes['quantity']) {

            $cart = Cart::where('user_id', auth()->user()->id)->first();
            if (!isset($cart)) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
            }
            if ($cart->save()) {

                $cart_product = CartProduct::where('cart_id', $cart->id)->where('product_id', $attributes['product_id'])->where('status', 'pending')->first();


                if (!isset($cart_product))
                    $cart_product = new CartProduct();
                else {
                    // check if same custom update, else new CartProduct

                    $cart_products = CartProduct::where('cart_id', $cart->id)->where('product_id', $attributes['product_id'])->where('status', 'pending')->get();

                    $has_same_custom = false;
                    foreach ($cart_products as $cart_prod) {
                        $custom_prv_id = CartProductCustom::where('cart_product_id', $cart_prod->id)->pluck('custom_id')->toArray();
                        if (isset($attributes['custom_id']))
                            if ($attributes['custom_id'] == $custom_prv_id) {
                                $cart_product = $cart_prod;
                                $has_same_custom = true;
                                break;
                            }
                    }
                    if (!$has_same_custom && (isset($attributes['custom_id'])))
                        $cart_product = new CartProduct();

                }
                $cart_product->cart_id = $cart->id;
                $cart_product->product_id = $attributes['product_id'];
                $cart_product->price = $product->price;
                $cart_product->quantity += $attributes['quantity'];
                $cart_product->store_id = $product->store_id;
                $cart_product->merchant_id = $product->merchant_id;
                $cart_product->save();

                $total_price = $product->price;
                if ($product->has_custom) {

                    if (isset($attributes['custom_id'])) {
//                        $total_price = 0;
                        CartProductCustom::where('cart_product_id', $cart_product->id)->forceDelete();

                        foreach ($attributes['custom_id'] as $custom_id) {

                            $product_custom = ProductCustomization::where('product_id', $product->id)->find($custom_id);

                            if ($product_custom->price == 0) {
                                $price = 0;
                            } else
                                $price = $product_custom->price;

                            $total_price += $price;


                            $cart_product_custom = new CartProductCustom();
                            $cart_product_custom->cart_product_id = $cart_product->id;
                            $cart_product_custom->custom_id = $product_custom->id;
                            $cart_product_custom->price = $product_custom->price;
                            $cart_product_custom->save();

                        }


                    }
                }

                // if is offer set price offer in cart
                if ($product->is_offer) {
                    $total_price = $total_price - ($total_price * $product->offer_percentage) / 100.0;
                }

//                $total_price = $total_price * $attributes['quantity'];


                $cart_product->price = $total_price;
                $cart_product->save();
                if (request()->isJson())
                    return $cart;
                return response_api(true, 200, 'Add product to cart successfully.', $cart);

            }


        }
        return response_api(false, 422, 'This quantity does not exists in the store', []);


    }

    function update(array $attributes, $id = null)
    {

    }

    function delete($id)
    {
        $cart = $this->model->where('user_id', auth()->user()->id)->find($id);

//        dd();
        if (isset($cart))
            $cart_product = CartProduct::where('cart_id', $cart->id)->where('status', 'pending');

        if (isset($cart) && $cart_product->delete()) {
            return response_api(true, 200, 'deleted successfully', $cart);
        }
        return response_api(false, 422, null, []);

    }


    function deleteProductCart($id)
    {
        // TODO: Implement delete() method.
        $cart = $this->model->where('user_id', auth()->user()->id)->first();

        if (isset($cart))
            $cart_product = CartProduct::where('cart_id', $cart->id)->where('status', 'pending')->find($id);

        if (isset($cart) && isset($cart_product) && $cart_product->delete()) {
            return response_api(true, 200, trans('app.deleted'), $cart_product);
        }
        return response_api(false, 422, null, []);

    }

    // re add product to cart after deleted
    public function undoProductCartDelete(array $attributes)
    {
        $cart = $this->model->where('user_id', auth()->user()->id)->first();
        $readd = CartProduct::where('cart_id', $cart->id)->where('status', 'pending')->where('id', $attributes['cart_product_id'])->withTrashed()->update(['deleted_at' => null]);

        return response_api(true, 200, null, $cart);
    }


}
