<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Adv;
use App\CartProduct;
use App\OrderProduct;
use App\Product;
use App\ProductRate;
use App\Repositories\Interfaces\Repository;
use App\User;
use DB;

class HomeEloquent implements Repository
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    function getAll(array $attributes)
    {

    }

    function getUserHome(array $attributes)
    {

        // TODO: Implement getAll() method.

        $merchants_active_id = User::where('type', 'merchant')->where('is_active', 1)->pluck('id');
        // Calculate top selling
        $offer_sponsor_products = $this->product->where(function ($query) {
            $query->Where('admin_is_sponsor', 1);
            // $query->where('is_offer', 1)->orWhere('admin_is_sponsor', 1);
        })->orderByDesc('created_at'); // offers and sponsors

        // Calculate New Product
        $new_products = $this->product->orderByDesc('created_at'); // new of products

        // Calculate popular

        $popular_products = Product::getPopular();
        // Calculate top selling
        $top_selling_products = Product::getTopSelling();

        if (isset($attributes['product_name'])) {
            $offer_sponsor_products = $offer_sponsor_products->where('name', 'LIKE', '%' . $attributes['product_name'] . '%');
            $new_products = $new_products->where('name', 'LIKE', '%' . $attributes['product_name'] . '%');
            $popular_products = $popular_products->where('name', 'LIKE', '%' . $attributes['product_name'] . '%');
            $top_selling_products = $top_selling_products->where('name', 'LIKE', '%' . $attributes['product_name'] . '%');
        }

        // filters city,near me, merchant name, category , price_range

        if (isset($attributes['city_id'])) {

            $merchants_id = User::where('city_id', $attributes['city_id'])->where('type', 'merchant')->pluck('id');

            $offer_sponsor_products = $offer_sponsor_products->whereIn('merchant_id', $merchants_id);
            $new_products = $new_products->whereIn('merchant_id', $merchants_id);
            $popular_products = $popular_products->whereIn('merchant_id', $merchants_id);
            $top_selling_products = $top_selling_products->whereIn('merchant_id', $merchants_id);
        }

        if (isset($attributes['latitude']) && isset($attributes['longitude'])) {

            $merchants_id = $this->getNearMerchants($attributes['latitude'], $attributes['longitude']);
            $offer_sponsor_products = $offer_sponsor_products->whereIn('merchant_id', $merchants_id);
            $new_products = $new_products->whereIn('merchant_id', $merchants_id);
            $popular_products = $popular_products->whereIn('merchant_id', $merchants_id);
            $top_selling_products = $top_selling_products->whereIn('merchant_id', $merchants_id);
        }

        if (isset($attributes['category_id'])) {
            $offer_sponsor_products = $offer_sponsor_products->where('category_id', $attributes['category_id']);
            $new_products = $new_products->where('category_id', $attributes['category_id']);
            $popular_products = $popular_products->where('category_id', $attributes['category_id']);
            $top_selling_products = $top_selling_products->where('category_id', $attributes['category_id']);
        }

        if (isset($attributes['merchant_name'])) {

            $merchants_id = User::where('username', 'LIKE', '%' . $attributes['merchant_name'] . '%')->where('type', 'merchant')->pluck('id');
            $offer_sponsor_products = $offer_sponsor_products->whereIn('merchant_id', $merchants_id);
            $new_products = $new_products->whereIn('merchant_id', $merchants_id);
            $popular_products = $popular_products->whereIn('merchant_id', $merchants_id);
            $top_selling_products = $top_selling_products->whereIn('merchant_id', $merchants_id);
        }

        if (isset($attributes['price_from']) && isset($attributes['price_to'])) {

            $offer_sponsor_products = $offer_sponsor_products->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
            $new_products = $new_products->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
            $popular_products = $popular_products->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
            $top_selling_products = $top_selling_products->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
        }

        if (request()->segment(1) == 'api') {
            $data = [
                'advertisements' => Adv::select(['id'])->where('status',1)->orderByDesc('created_at')->get()->each(function ($adv) {
                    $adv->setAppends(['image']);
                  }),
                'offer_sponsor_products' => $offer_sponsor_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(5)->get(),
                'new_products' => $new_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(5)->get(),
                'popular_products' => $popular_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(5)->get(),
                'top_selling_products' => $top_selling_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(5)->get(),
            ];

            return response_api(true, 200, null, $data);
        }

        $data = [
            'advertisements' => Adv::where('status',1)->orderByDesc('created_at')->take(4)->get(),
            'offer_sponsor_products' => $offer_sponsor_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(4)->get(),
            'new_products' => $new_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(4)->get(),
            'popular_products' => $popular_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(4)->get(),
            'top_selling_products' => $top_selling_products->where('is_active',1)->whereIn('merchant_id', $merchants_active_id)->take(4)->get(),
        ];
        return $data;


    }

    function getById($id)
    {
        // TODO: Implement getById() method.
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $rate = ProductRate::where('user_id', auth()->user()->id)->where('product_id', $attributes['product_id'])->first();
        if (!isset($rate))
            $rate = new ProductRate();
        $rate->user_id = auth()->user()->id;
        $rate->product_id = $attributes['product_id'];
        $rate->rate = $attributes['rate'];
        if ($rate->save())
            return response_api(true, 200, trans('app.create_rate'), $rate);
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getNearMerchants($lat, $long) // start = 1, end = 2
    {
        $merchant_id = [];
        if (isset($lat) && isset($long)) {
            $merchants = User::where('is_active', 1)->where('type', 'merchant')->get();
            $merchant_near_me_id = [];
            $merchant_near = [];

            foreach ($merchants as $merchant) {

                $distance = distance($lat, $long, $merchant->latitude, $merchant->longitude);
                //  $setting = Setting::find(7); //
                $predict_distance = 1000;
                //  (isset($setting)) ? intval($setting['title']) : 1;
                if ($distance <= $predict_distance) {
                    $merchant_near_me_id['merchant_id'] = $merchant->id;
                    $merchant_near_me_id['distance'] = $distance;
                    $merchant_near [] = $merchant_near_me_id;
                }
            }

            usort($merchant_near, function ($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            foreach ($merchant_near as $merchant) {
                $merchant_id[] = $merchant['merchant_id'];
            }

        }

        return $merchant_id;
    }

}
