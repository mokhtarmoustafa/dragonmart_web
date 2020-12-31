<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Product;
use App\ProductRate;
use App\Repositories\Interfaces\Repository;
use App\ServiceRate;
use App\ServiceRequest;

class RateEloquent implements Repository
{

    private $model, $product, $notificationSystem;

    public function __construct(ProductRate $model, Product $product, NotificationSystemEloquent $notificationSystem)
    {
        $this->model = $model;
        $this->product = $product;
        $this->notificationSystem = $notificationSystem;
    }

    function getAll(array $attributes)
    {

        // TODO: Implement getAll() method.

    }

    function getById($id)
    {
        // TODO: Implement getById() method.
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $rate = ProductRate::where('user_id', auth()->user()->id)->where('product_id', $attributes['action_id'])->first();
        if (!isset($rate))
            $rate = new ProductRate();
        $rate->user_id = auth()->user()->id;
        $rate->product_id = $attributes['action_id'];
        $rate->rate = $attributes['rate'];
        if ($rate->save()) {
            //rate_product
            $product = Product::find($attributes['action_id']);//
            $this->notificationSystem->sendNotification(auth()->user()->id, $product->merchant_id, $attributes['action_id'], 'rate_product');

            return response_api(true, 200, trans('app.create_rate', ['attribute' => 'product']), $rate);
        }
        return response_api(false, 422, null, []);

    }

    public function rateService(array $attributes)
    {
        $rate = ServiceRate::where('user_id', auth()->user()->id)->where('service_request_id', $attributes['action_id'])->first();

        if (!isset($rate))
            $rate = new ServiceRate();
        $rate->user_id = auth()->user()->id;
        $rate->service_request_id = $attributes['action_id']; //service_client_id
        $rate->rate = $attributes['rate'];
        if (isset($attributes['comment']))
            $rate->comment = $attributes['comment'];
        if ($rate->save()) {
            $request = ServiceRequest::with('Service')->where('service_client_id', $attributes['action_id'])->first(); // request for one service provider

            $this->notificationSystem->sendNotification(auth()->user()->id, $request->Service->user_id, $attributes['action_id'], 'rate_service');
            return response_api(true, 200, trans('app.create_rate', ['attribute' => 'service']), $rate);
        }
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
}