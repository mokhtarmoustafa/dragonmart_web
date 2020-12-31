<?php

/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Category;
use App\ProductCategory;
use App\ProviderCategory;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Store;
use App\StoreCategory;

class CategoryEloquent extends Uploader implements Repository
{

    private $model, $providerCategory, $notification;

    public function __construct(ProductCategory $model, ProviderCategory $providerCategory, NotificationEloquent $notificationEloquent)
    {
        $this->model = $model;
        $this->providerCategory = $providerCategory;
        $this->notification = $notificationEloquent;
    }

    // for cpanel
    function anyData()
    {
        //        $provider_cats = $this->providerCategory->orderByDesc('created_at');
        // $categories = $this->model->orderByRaw('-order_by DESC')->orderByDesc('created_at');
        $categories = ProductCategory::withTrashed()->whereNull("store_id")->orderByRaw('-order_by DESC')->orderByDesc('created_at');


        return datatables()->of($categories)
            ->editColumn('icon', function ($category) {
                if (isset($category->icon32))
                    return '<img src="' . $category->icon32 . '">';
                return '<img src="' . url('assets/unknown_ic.png') . '">';
            })
            ->addColumn('action', function ($category) {

                if ($category->deleted_at == null) {
                    return '<a href="' . url(admin_vw() . '/category/' . $category->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-category-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url('admin/category/' . $category->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
                } else {
                    return '<a href="' . url('admin/category/restore/' . $category->id) . '" class="btn btn-circle btn-icon-only red restore" title="Restore">
                                <i class="fa fa-reply"></i>
                            </a>';
                }
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function anyProviderData()
    {
        //        $provider_cats = $this->providerCategory->orderByDesc('created_at');
        $categories = $this->providerCategory->orderByDesc('created_at');


        return datatables()->of($categories)
            ->filter(function ($query) {

                if (request()->filled('search')) {
                    $search = request()->get('search');
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')->orWhere('name_ar', 'LIKE', '%' . $search['value'] . '%');
                }
            })
            ->editColumn('icon', function ($category) {
                if (isset($category->icon32))
                    return '<img src="' . $category->icon32 . '">';
                return '<img src="' . url('assets/unknown_ic.png') . '">';
            })
            ->addColumn('action', function ($category) {
                return '<a href="' . url(admin_vw() . '/service-category/' . $category->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-category-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url('admin/service-category/' . $category->id) . '" class="btn btn-circle btn-icon-only red service-delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function categoriesMerchantData()
    {
        $category_ids = StoreCategory::where('merchant_id', auth()->guard('admin')->user()->user_id)->pluck('category_id');
        $categories = $this->model->where('store_id',  auth()->guard('admin')->user()->user_id)->orderByDesc('created_at');

        return datatables()->of($categories)
            ->filter(function ($query) {

                if (request()->filled('search')) {
                    $search = request()->get('search');
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')->orWhere('name_ar', 'LIKE', '%' . $search['value'] . '%')->where('store_id',  auth()->guard('admin')->user()->user_id);
                }
            })
            ->editColumn('icon', function ($category) {
                return '<img src="' . $category->icon32 . '">';
            })
            ->addColumn('action', function ($category) {
                //                <a href="' . url(merchant_url() . '/category/' . $category->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-category-mdl" title="Edit">
                //                                        <i class="fa fa-edit"></i>
                //                                    </a>
                return '<a href="' . url(merchant_url() . '/category/' . $category->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-category-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(merchant_url() . '/category/' . $category->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        $categories = $this->model->whereNull("store_id")->orderByRaw('-order_by DESC')->orderByDesc('created_at')->get();
        if (request()->segment(1) == 'api')
            return response_api(true, 200, null, $categories);
        // return $categories;
    }

    function getProviderCategories(array $attributes)
    {
        // TODO: Implement getAll() method.
        $categories = $this->providerCategory->all();
        if (request()->segment(1) == 'api')
            return response_api(true, 200, null, $categories);
        return $categories;
    }

    function saveMerchantCategory(array $attributes)
    {
        // TODO: Implement getAll() method.
        $store = Store::where('merchant_id', auth()->user()->id)->first();
        if (isset($store)) {
            $store_cat = StoreCategory::where('store_id', $store->id)->where('merchant_id', auth()->user()->id)->where('category_id', $attributes['category_id'])->first();
            if (!isset($store_cat))
                $store_cat = new StoreCategory();
            $store_cat->store_id = $store->id;
            $store_cat->category_id = $attributes['category_id'];
            $store_cat->merchant_id = auth()->user()->id;

            if ($store_cat->save()) {
                return response_api(true, 200, null, $store_cat);
            }
        }
        return response_api(false, 422, null, []);
    }

    function getByIdCategory($id)
    {

        // dd($id);
        $category = $this->providerCategory->find($id);
        //dd($category);
        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (isset($category)) {
                return response_api(true, 200, null, $category);
            }
            return response_api(false, 422, null, []);
        }
        return $category;
    }

    function getById($id)
    {
        $category = $this->model->find($id);
        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (isset($category)) {
                return response_api(true, 200, null, $category);
            }
            return response_api(false, 422, null, []);
        }
        return $category;
    }

    function postMerchantCategory(array $attributes)
    {
        // TODO: Implement create() method.
        $store = Store::where('merchant_id', auth()->guard('admin')->user()->user_id)->first();

        $category = new StoreCategory();
        $category->store_id = $store->id;
        $category->merchant_id = auth()->guard('admin')->user()->user_id;
        $category->category_id = $attributes['category_id'];
        if ($category->save()) {

            $this->notification->addAdminNotification('The merchant add new category :' . $category->category_name);
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function create(array $attributes, $Private = false)
    {
        // TODO: Implement create() method.


        $category = new ProductCategory();
        $category->name = $attributes['name'];
        $category->name_ar = $attributes['name_ar'];
        $category->store_id = $Private ? auth()->guard('admin')->user()->user_id : null;
        $category->order_by = $attributes['order_by'];


        if ($category->save() && !$Private) {
            if (isset($attributes['icon'])) {
                $category->icon = $this->storeIconThumb('categories', $category->id, $attributes['icon']);
                $category->save();
            }
            return response_api(true, 200);
        } else if ($category->save() &&  $Private) {
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null, $Private = false)
    {
        // TODO: Implement create() method.

        $category = $this->model->find($id);
        if (!isset($category))
            $category = new ProductCategory();

        $category->name = $attributes['name'];
        $category->name_ar = $attributes['name_ar'];
        $category->order_by = $attributes['order_by'];

        if (isset($attributes['icon']))
            $category->icon = $this->storeIconThumb('categories', $id, $attributes['icon']);

        if ($category->save()) {

            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function delete($id)
    {
        if (auth()->guard('admin')->user()->type == 'merchant') {
            $category = ProductCategory::where('store_id', auth()->guard('admin')->user()->user_id)->where('id', $id)->first();
            $category_name = $category->category_name;
        } else // TODO: Implement delete() method.
        {
            $category = $this->model->find($id);
        }

        if (isset($category) && $category->delete()) {
            if (auth()->guard('admin')->user()->type == 'merchant')
                $this->notification->addAdminNotification('The merchant delete category :' . $category_name);

            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function restore($id)
    {
        if (auth()->guard('admin')->user()->type == 'merchant') {
            $category = ProductCategory::withTrashed()->where('store_id', auth()->guard('admin')->user()->user_id)->where('id', $id)->first();
            $category_name = $category->category_name;
        } else // TODO: Implement delete() method.
        {
            $category = $this->model->withTrashed()->find($id);
        }

        if (isset($category) && $category->restore()) {
            if (auth()->guard('admin')->user()->type == 'merchant')
                $this->notification->addAdminNotification('The merchant restore category :' . $category_name);

            return response_api(true, 200);
        }
        return response_api(false, 422);
    }


    function service_create(array $attributes)
    {
        // TODO: Implement create() method.


        $category = new ProviderCategory();
        $category->name = $attributes['name'];
        $category->name_ar = $attributes['name_ar'];
        if (isset($attributes['description']))
            $category->description = $attributes['description'];
        if ($category->save()) {
            if (isset($attributes['icon'])) {
                $category->icon = $this->storeIconThumb('service_categories', $category->id, $attributes['icon']);
                $category->save();
            }
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function service_update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

        $category = $this->providerCategory->find($id);
        if (!isset($category))
            $category = new ProviderCategory();

        $category->name = $attributes['name'];
        $category->name_ar = $attributes['name_ar'];

        if (isset($attributes['description']))
            $category->description = $attributes['description'];
        if (isset($attributes['icon']))
            $category->icon = $this->storeIconThumb('service_categories', $id, $attributes['icon']);

        if ($category->save()) {

            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function service_delete($id)
    {
        // TODO: Implement delete() method.
        $category = $this->providerCategory->find($id);
        if (isset($category) && $category->delete()) {
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }
}
