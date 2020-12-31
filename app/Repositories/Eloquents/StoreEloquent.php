<?php

/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Admin;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Store;
use App\StoreCategory;
use App\StoreDriver;
use App\StoreImage;

use App\User;

class StoreEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        $stores = $this->model->with('Merchant')->orderByDesc('created_at');
        return datatables()->of($stores)
            ->filter(function ($query) {

                if (request()->filled('name')) {
                    $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
                }
                if (request()->filled('merchant')) {

                    $merchants_id = Admin::where('type', 'merchant')->where('name', 'LIKE', '%' . request()->get('merchant') . '%')->pluck('id');
                    $query->whereIn('merchant_id', $merchants_id);
                }
            })->addColumn('action', function ($store) {
                return '<a href="' . url(admin_stores_url() . '/' . $store->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-store-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_stores_url() . '/' . $store->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['is_complete', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }


    function getById($id)
    {
        $store = $this->model->find($id);

        if (request()->segment(1) == 'admin')
            return $store;
        if (isset($store)) {
            return response_api(true, 200, [], $store);
        }
        return response_api(false, 422);
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $store = new Store();
        $store->name = $attributes['name'];
        $store->merchant_id = auth()->guard('admin')->user()->user_id;
        $store->description = $attributes['description'];
        if ($store->save()) {

            if (isset($attributes['files']) && count($attributes['files']) > 0) {
                foreach ($attributes['files'] as $image) {
                    $store_image = new StoreImage();
                    $store_image->store_id = $store->id;
                    $store_image->image = $this->storeImageThumb('stores', $store->id, $image);
                    $store_image->save();
                    sleep(2);
                }
            }
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

        $store = $this->model->find($id);
        if (!isset($store))
            $store = new Store();

        $store->name = $attributes['name'];
        $store->merchant_id = auth()->guard('admin')->user()->user_id;
        $store->description = $attributes['description'];

        if ($store->save()) {

            if (isset($attributes['files']) && count($attributes['files']) > 0) {

                foreach ($attributes['files'] as $image) {
                    $store_image = new StoreImage();
                    $store_image->store_id = $store->id;
                    $store_image->image = $this->storeImageThumb('stores', $store->id, $image);
                    $store_image->save();
                    sleep(2);
                }
            }
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $store = $this->model->find($id);
        if (isset($store) && $store->delete()) {

            if (auth()->guard('admin')->user()->type == 'admin')
                return response_api(true, 200);
            else
                return back();
        }
        return response_api(false, 422);
    }

    function recover($id)
    {
        // TODO: Implement delete() method.
        $store = $this->model->withTrashed()->find($id);
        if (isset($store) && $store->restore()) {
            return back();
        }
        return response_api(false, 422);
    }



    function deleteStoreImage($id)
    {
        // TODO: Implement delete() method.
        $storeImage = StoreImage::find($id);
        if (isset($storeImage) && $storeImage->forceDelete()) {
            return response_api(true, 200, null, []);
        }
        return response_api(false, 422, null, []);
    }

    function saveMerchantStore(array $attributes, $id = null)
    {
        // TODO: Implement create() method.
        $store = Store::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('id', $id)->first();
        if (!isset($store))
            $store = new Store();

        $store->name = $attributes['name'];
        $store->merchant_id = auth()->guard('admin')->user()->user_id;
        $store->description = $attributes['description'] ?? '';
        $store->lat = $attributes['lat'];
        $store->lng = $attributes['lng'];
        $store->phone = $attributes['phone'];
        
        
        if(isset($attributes['time'])){
            
            foreach($attributes['time']['open'] as $day => $opentimes){
                $attributes['time']['open'][$day] = $opentimes;
            }
            
            foreach($attributes['time']['close'] as $day => $closetimes){
                $attributes['time']['close'][$day] = $closetimes;
            }

            
             $store->open_times = json_encode($attributes['time']['open']);
             $store->close_times = json_encode($attributes['time']['close']);
             $store->state_times = json_encode($attributes['time']['state']);
        }

       

        if ($store->save()) {

            if (isset($attributes['category_id'])) {
                StoreCategory::where('store_id', $store->id)->forceDelete();

                foreach ($attributes['category_id'] as $category_id) {

                    $store_cat = new StoreCategory();
                    $store_cat->store_id = $store->id;
                    $store_cat->category_id = $category_id;
                    $store_cat->merchant_id = auth()->guard('admin')->user()->user_id;

                    $store_cat->save();
                }
            }

            if (isset($attributes['driver_id'])) {
                StoreDriver::where('store_id', $store->id)->forceDelete();

                foreach ($attributes['driver_id'] as $driver_id) {

                    $store_driver = new StoreDriver();
                    $store_driver->merchant_id = auth()->guard('admin')->user()->user_id;
                    $store_driver->store_id = $store->id;
                    $store_driver->driver_id = $driver_id;
                    $store_driver->save();
                }
            }
            //            if (isset($attributes['files']) && count($attributes['files']) > 0) {
            //                foreach ($attributes['files'] as $image) {
            //                    $store_image = new StoreImage();
            //                    $store_image->store_id = $store->id;
            //                    $store_image->image = $this->storeImageThumb('stores', $store->id, $image);
            //                    $store_image->save();
            //                    sleep(2);
            //                }
            //            }



            if (auth()->guard('admin')->user()->type == 'admin')
                return response_api(true, 200);
            else {
                return back();
            }
        }
        return response_api(false, 422);
    }

    // public function storeImages(array $attributes)
    // {
    //     if (request()->segment(1) == 'api') {

    //         $store = $this->model->where('merchant_id', auth()->user()->id)->first();
    //     } else
    //         $store = $this->model->where('merchant_id', auth()->guard('admin')->user()->user_id)->first();

    //     $images = [];
    //     if (!isset($store))
    //         return response_api(false, 422, "Merchant has not store...", []);
    //     if (isset($attributes['files']) && count($attributes['files']) > 0) {
    //         foreach ($attributes['files'] as $image) {
    //             $store_image = new StoreImage();
    //             $store_image->store_id = $store->id;
    //             $store_image->image = $this->storeImageThumb('stores', $store->id, $image);
    //             $store_image->save();
    //             sleep(1);
    //             $images[] = $store_image;
    //             if (request()->segment(1) != 'api') {
    //                 $file = StoreImage::find($store_image->id);
    //                 return response()->json(['files' => [$file], 'status' => true]);
    //             }
    //         }
    //     }


    //     return response_api(true, 200, null, $images);


    // }


    public function storeProfileImage($attributes)
    {
        if (request()->segment(1) == 'api') {

            $store = User::where('id', auth()->user()->id)->first();
        } else
            $store = User::where('id', auth()->guard('admin')->user()->user_id)->first();

        $images = [];
        if (!isset($store))
            return response_api(false, 422, "Merchant has not store...", []);
        if (isset($attributes['files']) && count($attributes['files']) > 0) {

            // $store_image = new User();
            // $store_image->store_id = $store->id;
            // $store_image->image = 
            // $store_image->save()

            User::where('id', auth()->user()->id)->update([
                'image' => $this->storeImageThumb('stores', $store->id, ($attributes['files'][0]))
            ]);


            sleep(1);

            //$images[] = $store_image;




            // if (request()->segment(1) != 'api') {
            //     $file = StoreImage::find($store_image->id);
            //     return response()->json(['files' => [$file], 'status' => true]);
            // }
        }


        return response_api(true, 200, null, $images);
    }
}
