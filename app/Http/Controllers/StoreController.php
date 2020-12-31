<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\Store\CreateRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\ProductCategory;
use App\Repositories\Eloquents\StoreEloquent;
use App\Store;
use App\StoreImage;
use App\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //
    private $store;

    public function __construct(StoreEloquent $storeEloquent)
    {
        parent::__construct();
        $this->store = $storeEloquent;
    }

    public function index()
    {
        $data = [
            'main_title' => 'stores',
            'icon' => 'fa fa-database',
        ];
        return view(admin_stores_vw() . '.index', $data);
    }

    public function storeData()
    {
        return $this->store->anyData();
    }


    //
    public function edit($id)
    {

        $store = $this->store->getById($id);

        $html = 'This store does not exist';
        if (isset($store)) {

            $images = StoreImage::where('store_id', $store->id)->get();
            $view = view()->make('modal', [
                'modal_id' => 'edit-store',
                'modal_title' => 'Edit store',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_user_tab_url() . '/stores/' . $id),
                    'form_id' => 'formEdit',

                    'fields' => [
                        'name' => 'text',
                        'merchant_id' => Admin::where('type', 'merchant')->get(),
                        'images' => 'file_multiple',
                    ],
                    'values' => [
                        'name' => $store->name,
                        'merchant_id' => $store->merchant_id,
                        'images' => $images,
                    ],
                    'fields_name' => [
                        'name' => 'Name',
                        'merchant_id' => 'Merchant',
                        'images' => 'Images',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

//
    public function update(UpdateRequest $request, $id)
    {
        return $this->store->update($request->all(), $id);
    }

//
    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-store',
            'modal_title' => 'Add new store',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_user_tab_url() . '/stores'),
                'form_id' => 'formAdd',
                'fields' => [
                    'name' => 'text',
                    'merchant_id' => Admin::where('type', 'merchant')->get(),
                    'images' => 'file_multiple',

                ],
                'fields_name' => [
                    'name' => 'Name',
                    'merchant_id' => 'Merchant',
                    'images' => 'Images',

                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

//
    public function store(CreateRequest $request)
    {
        return $this->store->create($request->all());
    }

    public function delete($id)
    {
        return $this->store->delete($id);
    }


    public function recover($id)
    {
          return $this->store->recover($id);
        }


    public function merchantStore()
    {
      $categories = ProductCategory::all();

        $drivers = User::where('type', 'driver')->get();

        $store = Store::where('merchant_id', auth()->guard('admin')->user()->user_id)->withTrashed()->get();

        $store = json_decode(json_encode($store) , true);

        // $data = [
        //     'main_title' => 'stores',
        //     'icon' => 'fa fa-database',
        //     'drivers' => $drivers,
        //     'categories' => $categories,
        //     'store' => $store
        // ];
        return view(merchant_store_vw() . '.index', compact('store' , 'categories'));
    }

    public function saveMerchantStore(Request $request , $id = null)
    {
        return $this->store->saveMerchantStore($request->all() , $id);
    }

    public function storeImages(Request $request)
    {
        return $this->store->storeImages($request->all());
    }

    public function getStoreImages()
    {
        $store = Store::where('merchant_id', auth()->guard('admin')->user()->user_id)->first();
        $files = StoreImage::where('store_id', $store->id)->get();
        return response()->json(['files' => $files]);
    }

    public function deleteStoreImage($id)
    {
        return $this->store->deleteStoreImage($id);
    }

}
