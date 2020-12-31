<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\ProviderCategory;
use App\Repositories\Interfaces\Repository;
use App\Service;
use App\ServiceClient;
use App\ServiceProviderCategory;
use App\ServiceRate;
use App\ServiceRequest;
use App\User;
use DB;

class ServiceEloquent implements Repository
{

    private $model, $category, $serviceClient, $serviceRequest, $user, $notificationSystem;

    public function __construct(Service $model, ProviderCategory $category, ServiceClient $serviceClient, ServiceRequest $serviceRequest, User $user, NotificationSystemEloquent $notificationSystem)
    {
        $this->model = $model;
        $this->category = $category;
        $this->serviceRequest = $serviceRequest;
        $this->serviceClient = $serviceClient;
        $this->user = $user;
        $this->notificationSystem = $notificationSystem;
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


    function getServiceRequest($id)
    {
        $service_client = $this->serviceClient->find($id);

        if (isset($service_client)) {
            return response_api(true, 200, null, $service_client);
        }
        return response_api(false, 422, null, []);
    }

    function getById($id)
    {
        $service = $this->model->find($id);

        if (isset($service)) {
            return response_api(true, 200, null, $service);
        }
        return response_api(false, 422, null, []);
    }


    function getServiceRequests(array $attributes)
    {
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;


        $services_id = $this->model->where('user_id', auth()->user()->id)->pluck('id');
        $service_client_ids = $this->serviceRequest->whereIn('service_id', $services_id)->pluck('service_client_id');
        $collection = $this->serviceClient->whereIn('id', $service_client_ids)->where('status', $attributes['status']);

        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->orderByDesc('created_at')->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
//            if (count($object) > 0)
            return response_api(true, 200, null, $object, $page_count, $page_number);
//            return response_api(true, 200, trans('app.not_data_found'), []);
        }
        return $object;
    }

    function getReviews(array $attributes)
    {
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;


        $services_id = $this->model->where('user_id', $attributes['service_provider_id'])->pluck('id');

        if (isset($attributes['service_name'])) {
            $services_id = $this->model->where('user_id', $attributes['service_provider_id'])->where('text', 'LIKE', '%' . $attributes['service_name'] . '%')->pluck('id');
        }

        $service_client_id = ServiceRequest::where('service_id', $services_id)->pluck('service_client_id');

        $collection = ServiceRate::whereIn('service_request_id', $service_client_id);
        if (isset($attributes['client_name'])) {

            $clients_id = User::where('username', 'LIKE', '%' . $attributes['client_name'] . '%')->pluck('id');
            $collection = $collection->whereIn('user_id', $clients_id);
        }
        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
//            if (count($object) > 0)
            return response_api(true, 200, null, $object, $page_count, $page_number);
//            return response_api(true, 200, trans('app.not_data_found'), []);
        }
        return $object;
    }

    function getServices(array $attributes)
    {
//        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
//        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        if (auth()->check() && auth()->user()->type == 'client') {
            $service_providers_active_id = User::where('type', 'service_provider')->where('is_active', 1)->pluck('id');
        } else {
            $service_providers_active_id = User::where('type', 'service_provider')->pluck('id');
        }


        $collection = $this->model->whereIn('user_id', $service_providers_active_id);

        if (isset($attributes['service_provider_id'])) {
            $collection = $collection->where('user_id', $attributes['service_provider_id'])->orderBy('created_at', 'desc');
        }
        if (isset($attributes['category_id'])) {
            $collection = $collection->where('category_id', $attributes['category_id'])->orderBy('created_at', 'desc');
        }
        if (isset($attributes['service_name'])) {
            $collection = $collection->where('text', 'LIKE', '%' . $attributes['service_name'] . '%')->orderBy('created_at', 'desc');
        }

        // filters city,near me, service provider name, category , price_range
        if (isset($attributes['search'])) {

            $users = User::where('username', 'LIKE', '%' . $attributes['search'] . '%')->orWhere('mobile', 'LIKE', '%' . $attributes['search'] . '%')->pluck('id');
            $service_clients = ServiceClient::whereIn('user_id', $users)->pluck('id');

            $collection = $collection->whereIn('service_client_id', $service_clients)->orWhere('service_client_id', $attributes['search']);

        }
        if (isset($attributes['city_id'])) {

            $service_providers_id = $this->user->where('city_id', $attributes['city_id'])->where('type', 'service_provider')->pluck('id');
            $collection = $collection->whereIn('user_id', $service_providers_id);
        }

        if (isset($attributes['latitude']) && isset($attributes['longitude'])) {

            $service_providers_id = $this->getNearMerchants($attributes['latitude'], $attributes['longitude']);
            $collection = $collection->whereIn('user_id', $service_providers_id);
        }

        if (isset($attributes['service_provider_name'])) {

            $service_providers_id = User::where('username', 'LIKE', '%' . $attributes['service_provider_name'] . '%')->where('type', 'service_provider')->pluck('id');
            $collection = $collection->whereIn('user_id', $service_providers_id);
        }

        if (isset($attributes['price_from']) && isset($attributes['price_to'])) {

            $collection = $collection->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
        }
        if (isset($attributes['status'])) {

            $service_ids = $this->serviceRequest->where('status', $attributes['status'])->orderByDesc('updated_at')->pluck('service_id')->toArray();
            $collection = $collection->whereIn('id', $service_ids)->orderBy(DB::raw('FIELD(`id`, ' . implode(',', $service_ids) . ')'));
        }

//        $count = $collection->count();
//        $page_count = page_count($count, $page_size);
//        $page_number = $page_number - 1;
//        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
//        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();
        $object = $collection->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
//            if (count($object) > 0)
//            return response_api(true, 200, null, $object, $page_count, $page_number);
            return response_api(true, 200, null, $object);
//            return response_api(true, 200, trans('app.not_data_found'), []);
        }
        return $object;

    }

    /**
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    function create(array $attributes)
    {

        $service = new Service();
//`user_id`, `category_id`, `text`, `price`,
        $service->user_id = auth()->user()->id;
        $service->category_id = $attributes['category_id'];
        $service->text = $attributes['text'];
        $service->price = $attributes['price'];
        if ($service->save())
            return response_api(true, 200, 'Service was created successfully.', $service);
        return response_api(false, 422, 'Service was created failure', []);

    }

    function update(array $attributes, $id = null)
    {
        $service = $this->model->where('user_id', auth()->user()->id)->find($id);
//`user_id`, `category_id`, `text`, `price`,
        if (isset($attributes['category_id']))
            $service->category_id = $attributes['category_id'];
        if (isset($attributes['text']))
            $service->text = $attributes['text'];
        if (isset($attributes['price']))
            $service->price = $attributes['price'];
        if ($service->save())
            return response_api(true, 200, 'Service was updated successfully.', $service);
        return response_api(false, 422, 'Service was updated failure', []);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $service = $this->model->where('user_id', auth()->user()->id)->find($id);
        if (isset($service) && $service->delete()) {
            return response_api(true, 200, 'Service was deleted successfully', []);
        }
        return response_api(false, 422, 'Service was deleted failure', []);

    }

    public function sendRequest(array $attributes)
    {
//        $service_request = $this->serviceRequest->where('status', 'pending')->where('user_id', auth()->user()->id)->where('service_id', $attributes['service_id'])->first();
        if (isset($attributes['service_client_id']))
            $service_client = $this->serviceClient->where('user_id', auth()->user()->id)->find($attributes['service_client_id']);
        if (!isset($service_client))
            $service_client = new ServiceClient();
        $service_client->user_id = auth()->user()->id;
        $service_client->arrival_date = $attributes['arrival_date'];
        $service_client->address = $attributes['address'];
        $service_client->latitude = $attributes['latitude'];
        $service_client->longitude = $attributes['longitude'];

        if ($service_client->save()) {
            foreach ($attributes['service_ids'] as $service_id) {
                $service = $this->model->find($service_id);
                $service_request = $this->serviceRequest->where('service_client_id', $service_client->id)->where('service_id', $service_id)->first();
                if (!isset($service) || isset($service_request)) continue;
                $service_request = new ServiceRequest();
//                `service_client_id`, `service_id`, `status`, `reject_reason`
                $service_request->service_client_id = $service_client->id;
                $service_request->service_id = $service_id;
                if ($service_request->save()) {
                    $service_client->total_price += $service->price;
                    $service_client->save();
                }


            }

            //send_service
            $this->notificationSystem->sendNotification(auth()->user()->id, $service_client->services[0]->user_id, $service_client->id, 'send_service');

            return response_api(true, 200, 'Request was sent to service provider.', $service_client);
        }
        return response_api(false, 422, 'Sending failure', []);

    }

    public function getProviderCategory()
    {

        $categories_id = ServiceProviderCategory::where('user_id', auth()->user()->id)->pluck('category_id');

        $provider_categories = ProviderCategory::whereIn('id', $categories_id)->get();
        return response_api(true, 200, null, $provider_categories);
    }

    public function changeStatus(array $attributes)
    {

        $reject_reason = null;
        if ($attributes['status'] == 'finished')
            $request = $this->serviceClient->where('status', 'accepted')->find($attributes['request_id']);
        else
//            $request = $this->serviceRequest->where('status', 'pending')->where('service_id', $attributes['service_id'])->first();
            $request = $this->serviceClient->where('status', 'pending')->find($attributes['request_id']);


        //client
        if (auth()->user()->type == 'client' && ($attributes['status'] == 'canceled' || $attributes['status'] == 'confirm_finished')) {
//            $request = $this->serviceRequest->where('status', 'pending')->where('service_id', $attributes['service_id'])->first();
            if ($attributes['status'] == 'canceled')
                $request = $this->serviceClient->where('status', 'pending')->find($attributes['request_id']);
            else
                $request = $this->serviceClient->where('status', 'finished')->find($attributes['request_id']);
//
            if (!isset($request) || $request->user_id != auth()->user()->id) {
                return response_api(false, 422, 'The request was failure', []);
            }

            $request->status = $attributes['status'];
            if ($request->save()) {
                ServiceRequest::where('service_client_id', $request->id)->update(['status' => $attributes['status']]);


                if ($attributes['status'] == 'canceled')
                    $this->notificationSystem->sendNotification(auth()->user()->id, $request->services[0]->user_id, $request->id, 'canceled_request');

                return response_api(true, 200, 'The request ' . $attributes['status'] . ' successfully.', $request);
            }

        }

//`service_client_id`, `service_id`, `status`, `reject_reason`

        if (isset($request) && auth()->user()->type == 'service_provider') {

            $request->status = $attributes['status'];
            if ($attributes['status'] == 'rejected') {
                $request->reject_reason = $attributes['reject_reason'];
                $reject_reason = $attributes['reject_reason'];
            }

            if ($request->save()) {

                ServiceRequest::where('service_client_id', $request->id)->update(['status' => $attributes['status'], 'reject_reason' => $reject_reason]);

                if ($attributes['status'] == 'accepted') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $request->user_id, $request->id, 'accepted_request');

                }
                if ($attributes['status'] == 'rejected') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $request->user_id, $request->id, 'rejected_request', $attributes['reject_reason']);

                }
                if ($attributes['status'] == 'finished') {
                    $this->notificationSystem->sendNotification(auth()->user()->id, $request->user_id, $request->id, 'finished_request');

                }
                return response_api(true, 200, 'The request ' . $attributes['status'] . ' successfully.', $request);
            }
        }
        return response_api(false, 422, 'The request was failure', []);

    }

    public function getNearServiceProviders($lat, $long) // start = 1, end = 2
    {
        $service_provider_id = [];
        if (isset($lat) && isset($long)) {
            $service_providers = $this->model->where('type', 'service_provider')->where('is_active', 1)->get();
            $service_provider_near_me_id = [];
            $service_provider_near = [];

            foreach ($service_providers as $service_provider) {
                $distance = distance($lat, $long, $service_provider->latitude, $service_provider->longitude);

                if ($distance <= 100) {
                    $service_provider_near_me_id['service_provider_id'] = $service_provider->id;
                    $service_provider_near_me_id['distance'] = $distance;
                    $service_provider_near [] = $service_provider_near_me_id;
                }
            }

            usort($service_provider_near, function ($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            foreach ($service_provider_near as $service_provider) {
                $service_provider_id[] = $service_provider['service_provider_id'];
            }

        }

        return $service_provider_id;
    }

    public function getNearMerchants($lat, $long) // start = 1, end = 2
    {
        $merchant_id = [];
        if (isset($lat) && isset($long)) {
            $merchants = $this->model->where('type', 'merchant')->where('is_active', 1)->get();
            $merchant_near_me_id = [];
            $merchant_near = [];

            foreach ($merchants as $merchant) {
                $distance = distance($lat, $long, $merchant->latitude, $merchant->longitude);

                if ($distance <= 100) {
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
