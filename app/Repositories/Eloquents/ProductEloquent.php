<?php

/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Product;
use App\ProductCustomization;
use App\Customization;
use App\ProductImage;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Store;
use App\StoreImage;
use App\User;
use Carbon\Carbon;
use DB;

class ProductEloquent extends Uploader implements Repository
{

  private $model, $store, $product_customization, $notification;

  public function __construct(Product $model, Store $store, ProductCustomization $productCustomization, NotificationEloquent $notificationEloquent)
  {
    $this->model = $model;
    $this->store = $store;
    $this->product_customization = $productCustomization;
    $this->notification = $notificationEloquent;
  }

  // for cpanel
  function anyData()
  {
    $products = $this->model->with('Category')->withTrashed()->orderByDesc('created_at');

    return datatables()->of($products)
      ->filter(function ($query) {

        if (request()->filled('merchant_id')) {
          $query->where('merchant_id', request()->get('merchant_id'));
        }
        if (request()->filled('name')) {
          $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
        if (request()->filled('is_offer')) {
          $query->where('is_offer', request()->get('is_offer'));
        }
        if (request()->filled('is_sponsor')) {
          $query->where('is_sponsor', request()->get('is_sponsor'));
        }
        if (request()->filled('category_id')) {
          $query->where('category_id', request()->get('category_id'));
        }
      })
      ->addColumn('category_name', function ($product) {
        return (isset($product->Category)) ? $product->Category->name : '-';
      })
      ->editColumn('is_offer', function ($product) {
        if ($product->is_offer) {

          return '<label>Yes</label>';
        }
        return '<label>No</label>';
      })->editColumn('is_sponsor', function ($product) {
        if ($product->is_sponsor) {
          return '<label>Yes</label>';
        }
        return '<label>No</label>';
      })
      ->addColumn('action', function ($product) {

        $action = '<a href="' . url(getAuth()->type . '/change-product-status/' . $product->id) . '" class="btn btn-circle btn-icon-only green  set_product_active" data-id="' . $product->id . '" title=" Activate ">
      <i class="fa fa-check "></i>
      </a>';;
        if ($product->is_active) {
          $action = '<a href="' . url(getAuth()->type . '/change-product-status/' . $product->id) . '" class="btn btn-circle btn-icon-only red  set_product_active" data-id="' . $product->id . '" title=" Suspend ">
        <i class="fa fa-power-off "></i>
        </a>';
        }
        $action .= '<a href="' . url(getAuth()->type . '/store/product-images/' . $product->id) . '" class="btn btn-circle btn-icon-only blue edit-product-images-mdl" title="Images">
      <i class="fa fa-photo"></i> ' . $product->images->count() . '
      </a>
      <a href="' . url(getAuth()->type . '/product/' . $product->id . '/edit') . '" class="btn btn-circle btn-icon-only purple" target="_blank" title="Edit">
      <i class="fa fa-edit"></i>
      </a>

      ';
        if (isset($product->deleted_at)) {
          $action .= '<a href="' . url(getAuth()->type . '/undo-delete-product/' . $product->id) . '" class="btn btn-circle btn-icon-only default undo_delete_product" title="Undo delete">
        <i class="fa fa-undo"></i>
        </a>';
        } else {
          $action .=  '<a href="' . url(getAuth()->type . '/product/' . $product->id) . '" class="btn btn-circle btn-icon-only red delete_product" title="Delete">
        <i class="fa fa-trash"></i>
        </a>';
        }
        return $action;
      })->addIndexColumn()
      ->rawColumns(['is_offer', 'is_sponsor', 'action'])->toJson();
  }

  function orderProductsData($order_id)
  {
    $products = $this->model->where('order_id', $order_id)->with('Category')->withTrashed()->orderByDesc('created_at');

    return datatables()->of($products)
      ->filter(function ($query) {

        if (request()->filled('merchant_id')) {
          $query->where('merchant_id', request()->get('merchant_id'));
        }
        if (request()->filled('name')) {
          $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
        if (request()->filled('is_offer')) {
          $query->where('is_offer', request()->get('is_offer'));
        }
        if (request()->filled('is_sponsor')) {
          $query->where('is_sponsor', request()->get('is_sponsor'));
        }
        if (request()->filled('category_id')) {
          $query->where('category_id', request()->get('category_id'));
        }
      })->addColumn('category_name', function ($product) {
        return (isset($product->Category)) ? $product->Category->name : '-';
      })->editColumn('is_offer', function ($product) {
        if ($product->is_offer) {

          return '<label>Yes</label>';
        }
        return '<label>No</label>';
      })->editColumn('is_sponsor', function ($product) {
        if ($product->is_sponsor) {
          return '<label>Yes</label>';
        }
        return '<label>No</label>';
      })->addColumn('action', function ($product) {

        $action = '<a href="' . url(getAuth()->type . '/change-product-status/' . $product->id) . '" class="btn btn-circle btn-icon-only green  set_product_active" data-id="' . $product->id . '" title=" Activate ">
      <i class="fa fa-check "></i>
      </a>';
        if ($product->is_active) {
          $action = '<a href="' . url(getAuth()->type . '/change-product-status/' . $product->id) . '" class="btn btn-circle btn-icon-only red  set_product_active" data-id="' . $product->id . '" title=" Suspend ">
        <i class="fa fa-power-off "></i>
        </a>';
        }
        $action .= '<a href="' . url(getAuth()->type . '/store/product-images/' . $product->id) . '" class="btn btn-circle btn-icon-only blue edit-product-images-mdl" title="Images">
      <i class="fa fa-photo"></i> ' . $product->images->count() . '
      </a>
      <a href="' . url(getAuth()->type . '/product/' . $product->id . '/edit') . '" class="btn btn-circle btn-icon-only purple" target="_blank" title="Edit">
      <i class="fa fa-edit"></i>
      </a>

      ';
        if (isset($product->deleted_at)) {
          $action .= '<a href="' . url(getAuth()->type . '/undo-delete-product/' . $product->id) . '" class="btn btn-circle btn-icon-only default undo_delete_product" title="Undo delete">
        <i class="fa fa-undo"></i>
        </a>';
        } else {
          $action .=  '<a href="' . url(getAuth()->type . '/product/' . $product->id) . '" class="btn btn-circle btn-icon-only red delete_product" title="Delete">
        <i class="fa fa-trash"></i>
        </a>';
        }
        return $action;
      })->addIndexColumn()
      ->rawColumns(['is_offer', 'is_sponsor', 'action'])->toJson();
  }

  function sponsorRequestsData()
  {
    $products = $this->model->with('Merchant', 'Category')->where('is_sponsor', 1)->orderByDesc('created_at'); //->where('admin_is_sponsor', '<>', 1)

    return datatables()->of($products)
      ->filter(function ($query) {

        if (request()->filled('merchant_id')) {
          $query->where('merchant_id', request()->get('merchant_id'));
        }
        if (request()->filled('name')) {
          $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
        if (request()->filled('is_offer')) {
          $query->where('is_offer', request()->get('is_offer'));
        }
        if (request()->filled('is_sponsor')) {
          $query->where('is_sponsor', request()->get('is_sponsor'));
        }
        if (request()->filled('category_id')) {
          $query->where('category_id', request()->get('category_id'));
        }
      })
      ->addColumn('merchant_name', function ($product) {
        return '<a href="' . url(admin_user_tab_url() . '/user-det/' . $product->Merchant->id) . '" >' . $product->Merchant->username . '</a>';
      })
      //            ->editColumn('is_offer', function ($product) {
      //                if ($product->is_offer) {
      //
      //                    return '<label>Yes</label>';
      //
      //                }
      //                return '<label>No</label>';
      //
      //            })->editColumn('is_sponsor', function ($product) {
      //                if ($product->is_sponsor) {
      //                    return '<label>Yes</label>';
      //
      //                }
      //                return '<label>No</label>';
      //
      //            })
      ->addColumn('action', function ($product) {

        if ($product->admin_is_sponsor)
          return '<a href="' . url(getAuth()->type . '/store/product-images/' . $product->id) . '" class="btn btn-circle btn-icon-only btn-danger edit-product-images-mdl" title="Images">
      <i class="fa fa-photo"></i> ' . $product->images->count() . '
      </a><a href="' . url(admin_sponsor_tab_url() . '/change-product-sponsor/' . $product->id) . '" class="btn btn-circle btn-icon-only red  set_product_sponsor" data-id="' . $product->id . '" title=" suspend sponsor ">
      <i class="fa fa-power-off "></i>
      </a>';
        else
          return '<a href="' . url(getAuth()->type . '/store/product-images/' . $product->id) . '" class="btn btn-circle btn-icon-only btn-primary edit-product-images-mdl" title="Images">
      <i class="fa fa-photo"></i> ' . $product->images->count() . '
      </a><a href="' . url(admin_sponsor_tab_url() . '/change-product-sponsor/' . $product->id) . '" class="btn btn-circle btn-icon-only green  set_product_sponsor" data-id="' . $product->id . '" title=" activate sponsor ">
      <i class="fa fa-check "></i>
      </a>';
      })->addIndexColumn()
      ->rawColumns(['merchant_name', 'action'])->toJson();
  }

  public function changeSponsorStatus($product_id)
  {
    $product = $this->model->find($product_id);
    if (isset($product)) {
      $product->admin_is_sponsor = !$product->admin_is_sponsor;
      if ($product->admin_is_sponsor)
        $product->end_date_sponsor = Carbon::now()->addDays($product->sponsor_duration);
      $product->save();
      return response_api(true, 200, null, []);
    }
    return response_api(false, 422, null, []);
  }

  public function changeStatus($product_id)
  {
    $product = $this->model->find($product_id);
    if (isset($product)) {
      $product->is_active = !$product->is_active;
      $product->save();
      return response_api(true, 200, null, []);
    }
    return response_api(false, 422, null, []);
  }

  public function undo_delete_product($product_id)
  {
    if (auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin") {
      $product = $this->model->withTrashed()->find($product_id);
    } else {
      $product = $this->model->where('merchant_id', auth()->guard('admin')->user()->user_id)->withTrashed()->find($product_id);
    }

    if (isset($product)) {
      $product->deleted_at = null;
      $product->save();
      return response_api(true, 200, null, []);
    }
    return response_api(false, 422, null, []);
  }

  function productMerchantData()
  {
    $products = $this->model->with('Category')->where('merchant_id', auth()->guard('admin')->user()->user_id)->withTrashed()->orderByDesc('created_at');

    return datatables()->of($products)
      ->filter(function ($query) {

        if (request()->filled('merchant_id')) {
          $query->where('merchant_id', request()->get('merchant_id'));
        }
        if (request()->filled('name')) {
          $query->where('name', 'LIKE', '%' . request()->get('name') . '%');
        }
        if (request()->filled('is_offer')) {
          $query->where('is_offer', request()->get('is_offer'));
        }
        if (request()->filled('is_sponsor')) {
          $query->where('is_sponsor', request()->get('is_sponsor'));
        }
        if (request()->filled('category_id')) {
          $query->where('category_id', request()->get('category_id'));
        }
      })
      ->addColumn('category_name', function ($product) {
        return (isset($product->Category)) ? $product->Category->name : '-';
      })
      ->editColumn('is_offer', function ($product) {

        if ($product->is_active) {
          $active = '';
          $not_active = 'selected';
          if ($product->is_offer) {
            $active = 'selected';
            $not_active = '';
          }

          return '<select class="form-control input-md set-offer" data-id="' . $product->id . '" name="is_offer">
        <option value="0" ' . $not_active . '>No</option>
        <option value="1" ' . $active . '>Yes</option>

        </select>';
        }
        return ($product->is_offer) ? 'Yes' : 'No';
      })->editColumn('is_sponsor', function ($product) {

        if ($product->is_active) {

          $active = '';
          $not_active = 'selected';
          if ($product->is_sponsor) {
            $active = 'selected';
            $not_active = '';

            if (auth()->guard('admin')->user()->type == 'admin') {
              return '<label>Yes</label>';
            }
          }
          if (auth()->guard('admin')->user()->type == 'admin') {
            return '<label>No</label>';
          }
          return '<select class="form-control input-md set-sponsor" data-id="' . $product->id . '" name="is_sponsor">
        <option value="0" ' . $not_active . '>No</option>
        <option value="1" ' . $active . '>Yes</option>

        </select>';
        }
        return ($product->is_sponsor) ? 'Yes' : 'No';
      })
      ->addColumn('action', function ($product) {

        if ($product->is_active) {

          $action = '<a href="' . url(merchant_url() . '/product/' . $product->id) . '" class="btn btn-circle btn-icon-only red delete_product" title="Delete">
        <i class="fa fa-trash"></i>
        </a>';
          if (isset($product->deleted_at)) {
            $action = '<a href="' . url(merchant_url() . '/undo-delete-product/' . $product->id) . '" class="btn btn-circle btn-icon-only default undo_delete_product" title="Undo delete">
          <i class="fa fa-undo"></i>
          </a>';
          }

          // if (!$product->is_active) { $action .= '<span class="label label-danger" title="Product was disabled by super admin">Disabled</span>';}

          return '<a href="' . url(merchant_store_url() . '/product-images/' . $product->id) . '" class="btn btn-circle btn-icon-only green edit-product-images-mdl" title="Images">
        <i class="fa fa-images"></i> ' . $product->images->count() . '
        </a>
        <a href="' . url(merchant_url() . '/product/' . $product->id . '/edit') . '" class="btn btn-circle btn-icon-only purple" target="_blank" title="Edit">
        <i class="fa fa-edit"></i>
        </a>
        ' . $action;
        }
        return '<span class="label label-danger" title="Product was disabled by super admin">Disabled</span>';
      })->addIndexColumn()
      ->rawColumns(['is_offer', 'is_sponsor', 'action'])->toJson();
  }

  function getAll(array $attributes)
  {
    // TODO: Implement getAll() method.
    return $this->model->all();
  }

  function getProducts(array $attributes)
  {

    $merchants_active_id = User::where('type', 'merchant')->where('is_active', 1)->pluck('id');

    $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
    $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
    $old_page = $page_number;

    //        $merchants_id = User::where('is_active', 1)->pluck('id');
    $collection = $this->model->where('is_active', 1); //->whereIn('merchant_id', $merchants_id);

    //        $type = popular, $type = top_selling, $type = new_product ,
    if (isset($attributes['type'])) {
      if ($attributes['type'] == 'popular') {
        $collection = Product::getPopular();
      } else if ($attributes['type'] == 'top_selling') {
        $collection = Product::getTopSelling();
      } else if ($attributes['type'] == 'new_product') {
        //15 - 7  < (20 - 7) - 7 = 13 - 7
        $collection = $this->model->whereDate('created_at', '>', Carbon::now()->subWeek());
      }
    }

    if (isset($attributes['merchant_id'])) {
      $collection = $collection->where('merchant_id', $attributes['merchant_id'])->orderBy('created_at', 'desc');
    }
    if (isset($attributes['category_id'])) {
      $collection = $collection->where('category_id', $attributes['category_id'])->orderBy('created_at', 'desc');
    }
    if (isset($attributes['product_name'])) {
      $collection = $collection->where('name', 'LIKE', '%' . $attributes['product_name'] . '%')->orderBy('created_at', 'desc');
    }

    // filters city,near me, merchant name, category , price_range

    if (isset($attributes['city_id'])) {

      $merchants_id = User::where('city_id', $attributes['city_id'])->where('type', 'merchant')->pluck('id');
      $collection = $collection->whereIn('merchant_id', $merchants_id);
    }

    if (isset($attributes['latitude']) && isset($attributes['longitude'])) {

      $merchants_id = $this->getNearMerchants($attributes['latitude'], $attributes['longitude']);
      $collection = $collection->whereIn('merchant_id', $merchants_id);
    }

    if (isset($attributes['merchant_name'])) {

      $merchants_id = User::where('username', 'LIKE', '%' . $attributes['merchant_name'] . '%')->where('type', 'merchant')->pluck('id');
      $collection = $collection->whereIn('merchant_id', $merchants_id);
    }

    if (isset($attributes['price_from']) && isset($attributes['price_to'])) {

      if ($attributes['price_to'] == 1000) {
        $collection = $collection->where('price', '>=', $attributes['price_from']);
      } else
        $collection = $collection->where('price', '>=', $attributes['price_from'])->where('price', '<=', $attributes['price_to']);
    }

    if (\request()->segment(1) != 'api') { // web site

      if (isset($attributes['categories_ids'])) {
        $collection = $collection->whereIn('category_id', $attributes['categories_ids']);
      }
    }

    $count = $collection->count();
    $page_count = page_count($count, $page_size);
    $page_number = $page_number - 1;
    $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;

    if (auth()->check() && auth()->user()->type == 'merchant')
      $object = $collection->where('is_active', 1)->where('merchant_id', auth()->user()->id)->take($page_size)->skip((int)$page_number * $page_size)->get();
    else
      $object = $collection->where('is_active', 1)->whereIn('merchant_id', $merchants_active_id)->take($page_size)->skip((int)$page_number * $page_size)->get();

    if (request()->segment(1) == 'api' || request()->ajax()) {
      //            if (count($object) > 0)
      return response_api(true, 200, null, $object, $page_count, $page_number);
      //            return response_api(true, 200, trans('app.not_data_found'), []);
    }
    $arr['items'] = $object;
    $arr['total_pages'] = (int)$page_count;
    $arr['current_page'] = $old_page;
    return (object)$arr;
  }


  function getById($id)
  {
    $product = $this->model->find($id);
    $product['custom'] = Customization::where('product_id', $product->id)->get();

    if (request()->segment(1) == 'api') {

      if (isset($product)) {
        return response_api(true, 200, null, $product);
      }
      return response_api(false, 422, null, []);
    }
    return $product;
  }

  function create(array $attributes, $id = null)
  {
    // TODO: Implement create() method.
    // return response_api(false, 422, null, $attributes);
    $store = $this->store->where('merchant_id', is_null($id) ?  auth()->guard('admin')->user()->user_id : $id)->first();

    $product = new Product();
    $product->name = $attributes['name'];
    $product->price = $attributes['price'];
    $product->original_quantity = $attributes['original_quantity'];
    $product->available_quantity = $attributes['original_quantity'];
    $product->is_offer = (isset($attributes['is_offer']) && $attributes['is_offer'] == 'on') ? 1 : 0;
    $product->offer_percentage = (isset($attributes['is_offer']) && $attributes['is_offer'] == 'on') ? $attributes['offer_percentage'] : null;
    $product->is_sponsor = (isset($attributes['is_sponsor']) && $attributes['is_sponsor'] == 'on') ? 1 : 0;
    $product->category_id = $attributes['category_id'];
    $product->description = $attributes['description'];
    $product->merchant_id = is_null($id) ?  auth()->guard('admin')->user()->user_id : $id;
    $product->store_id = $store->id;

    $product->has_custom = isset($attributes['custom']) && count($attributes['custom']) > 0;
    if ((isset($attributes['is_sponsor']) && $attributes['is_sponsor'] == 'on'))
      $product->sponsor_duration = $attributes['sponsor_duration'];
    if ($product->save()) {
      is_null($id) ??  $this->notification->addAdminNotification('The merchant added new a product :' . $product->name);
      if (isset($attributes['custom']) && count($attributes['custom']) > 0) {
        //                $count = 0;
        $temp = 0;
        foreach ($attributes['custom'] as $index => $custom_id) {

          //                    if ($attributes['is_default'][$index])
          //                        $count++
          $elm = $attributes['custom'][$index];
          $product_custom = new Customization();
          $product_custom->product_id = $product->id;
          $product_custom->name = $elm['name'];
          $product_custom->type = $elm['type'];
          $product_custom->options = json_encode(array_values($elm['option']));
          $product_custom->min = $elm['min'];
          $product_custom->max = $elm['max'];



          // $product_custom->custom_id = $custom_id;
          // if (!isset($attributes['custom_price'][$index]) || $attributes['custom_price'][$index] == 0)
          //     $product_custom->is_default = 1;
          // $product_custom->price = isset($attributes['custom_price'][$index]) ? $attributes['custom_price'][$index] : 0;
          // $product_custom->text = $attributes['custom_text'][$index];
          // $product_custom->description = $attributes['custom_description'][$index];
          $product_custom->save();
          // $temp = $custom_id;
        }
        //                if ($count == 0) { // at least one custom as default
        //                    $product_custom = ProductCustomization::where('product_id', $product->id)->first();
        ////                    $product_custom->is_default = 1;
        //                    $product_custom->save();
        //                }
      }

      $ProductUserType = auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin" ? "admin" : "merchant";

      // return redirect()->route($ProductUserType.'/product/'.$product->id.'/edit');

      return response_api(true, 200, null, $product);
    }
    return response_api(false, 422);
  }

  function update(array $attributes, $id = null)
  {
    // TODO: Implement create() method.

    if (auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin") {
      $product = Product::find($id);
      $merchant_id = $product->merchant_id;
    } else {
      $merchant_id = auth()->guard('admin')->user()->user_id;
    }

    $store = $this->store->where('merchant_id', $merchant_id)->first();

    $product = $this->model->with('Customizations')->where('store_id', $store->id)->find($id);

    if (!isset($product))
      return response_api(false, 422);

    $product->name = $attributes['name'];
    $product->price = $attributes['price'];
    $product->original_quantity = $attributes['original_quantity'];
    $product->available_quantity = $attributes['original_quantity'];
    $product->is_offer = (isset($attributes['is_offer']) && $attributes['is_offer'] == 'on') ? 1 : 0;
    $product->offer_percentage = (isset($attributes['is_offer']) && $attributes['is_offer'] == 'on') ? $attributes['offer_percentage'] : null;
    $product->is_sponsor = (isset($attributes['is_sponsor']) && $attributes['is_sponsor'] == 'on') ? 1 : 0;
    $product->category_id = $attributes['category_id'];
    $product->description = $attributes['description'];
    $product->merchant_id = $merchant_id;
    $product->store_id = $store->id;
    $product->has_custom = isset($attributes['custom']) && count($attributes['custom']) > 0;
    $product->has_custom = isset($attributes['custom']) && count($attributes['custom']) > 0;
    if ((isset($attributes['is_sponsor']) && $attributes['is_sponsor'] == 'on'))
      $product->sponsor_duration = $attributes['sponsor_duration'];
    if ($product->save()) {
      ProductCustomization::where('product_id', $product->id)->forceDelete();

      if (isset($attributes['custom']) && count($attributes['custom']) > 0) {

        //                $count = 0;
        $temp = 0;
        Customization::where('product_id', $product->id)->forceDelete();

        foreach ($attributes['custom'] as $index => $custom_id) {

          //                    if ($attributes['is_default'][$index])
          //                        $count++
          $elm = $attributes['custom'][$index];
          $product_custom = new Customization();
          $product_custom->product_id = $product->id;
          $product_custom->name = $elm['name'];
          $product_custom->type = $elm['type'];
          $product_custom->options = json_encode(array_values($elm['option']));
          $product_custom->min = $elm['min'];
          $product_custom->max = $elm['max'];


          // $product_custom->custom_id = $custom_id;
          // if (!isset($attributes['custom_price'][$index]) || $attributes['custom_price'][$index] == 0)
          //     $product_custom->is_default = 1;
          // $product_custom->price = isset($attributes['custom_price'][$index]) ? $attributes['custom_price'][$index] : 0;
          // $product_custom->text = $attributes['custom_text'][$index];
          // $product_custom->description = $attributes['custom_description'][$index];
          $product_custom->save();
          // $temp = $custom_id;
        }

        //                if ($count == 0) { // at least one custom as default
        //                    $product_custom = ProductCustomization::where('product_id', $product->id)->first();
        ////                    $product_custom->is_default = 1;
        //                    $product_custom->save();
        //                }
      }

      return response_api(true, 200, null, $product);
    }
    return response_api(false, 422);
  }

  function delete($id)
  {
    // TODO: Implement delete() method.
    $product = $this->model->find($id);
    if (isset($product) && $product->delete()) {
      return response_api(true, 200);
    }
    return response_api(false, 422);
  }

  function setSponsor($id)
  {
    // TODO: Implement delete() method.
    $product = $this->model->find($id['product_id']);

    if (isset($product)) {
      $product->is_sponsor = !$product->is_sponsor;

      if ($product->save()) {
        return response_api(true, 200);
      }
    }
    return response_api(false, 422);
  }

  function setOffer($id)
  {
    // TODO: Implement delete() method.
    $product = $this->model->find($id['product_id']);

    if (isset($product)) {
      $product->is_offer = !$product->is_offer;

      if ($product->save()) {
        return response_api(true, 200);
      }
    }
    return response_api(false, 422);
  }

  public function productImages(array $attributes, $product_id)
  {
    if (isset($attributes['files']) && count($attributes['files']) > 0) {
      foreach ($attributes['files'] as $image) {
        $product_image = new ProductImage();
        $product_image->product_id = $product_id;
        $product_image->image = $this->storeImageThumb('products', $product_id, $image);
        $product_image->save();

        //                sleep(5);
        $file = ProductImage::find($product_image->id);
        return response()->json(['files' => [$file], 'status' => true]);
      }
    }
  }

  function deleteProductImage($id)
  {
    // TODO: Implement delete() method.
    $productImage = ProductImage::find($id);
    if (isset($productImage) && $productImage->forceDelete()) {
      return response_api(true, 200);
    }
    return response_api(false, 422);
  }

  public function getNearMerchants($lat, $long) // start = 1, end = 2
  {
    $service_provider_id = [];
    if (isset($lat) && isset($long)) {
      $service_providers = $this->model->where('type', 'service_provider')->where('is_active', 1)->get();
      $service_provider_near_me_id = [];
      $service_provider_near = [];

      foreach ($service_providers as $service_provider) {
        $distance = distance($lat, $long, $service_provider->latitude, $service_provider->longitude);


        //                $setting = Setting::find(7); // المسافة التقريبية بكيلو متر

        //                $predict_distance = (isset($setting)) ? intval($setting['title']) : 1;

        if ($distance <= 100) {
          $service_provider_near_me_id['service_provider_id'] = $service_provider->id;
          $service_provider_near_me_id['distance'] = $distance;
          $service_provider_near[] = $service_provider_near_me_id;
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
}
