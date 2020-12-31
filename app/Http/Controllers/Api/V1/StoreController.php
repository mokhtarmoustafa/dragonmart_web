<?php

namespace App\Http\Controllers\Api\V1;

use App\Admin;
use App\Http\Controllers\Controller;
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

    public function storeImages(Request $request)
    {
        return $this->store->storeImages($request->all());
    }

    public function deleteStoreImage($id)
    {
        return $this->store->deleteStoreImage($id);
    }
}
