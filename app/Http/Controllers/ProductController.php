<?php

namespace App\Http\Controllers;

use App\Customization;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Repositories\Eloquents\ProductEloquent;
use App\Store;
use App\StoreImage;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    private $product, $category;

    public function __construct(ProductEloquent $product, ProductCategory $category)
    {
        parent::__construct();

        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        $store = Store::with('Categories')->where('merchant_id', getAuth()->user_id)->first();
        $categories = ProductCategory::where('store_id',  getAuth()->user_id);


        $data = [
            'main_title' => 'Products',
            'icon' => 'icon-grid',
            'categories' => $categories->get(),
            //            'drivers' => $store->Drivers()->get(),
        ];
        return view(merchant_vw() . '.products.index', $data);
    }

    public function sponsorRequests()
    {
        //        $store = Store::with('Categories')->where('merchant_id', getAuth()->user_id)->first();
        $data = [
            'main_title' => 'Sponsors requests',
            'icon' => 'fa fa-certificate',
            //            'categories' => $store->Categories()->get(),
            //            'drivers' => $store->Drivers()->get(),
        ];
        return view(admin_vw() . '.sponsor_requests.index', $data);
    }

    public function sponsorRequestsData()
    {
        return $this->product->sponsorRequestsData();
    }

    public function changeSponsorStatus($product_id)
    {
        return $this->product->changeSponsorStatus($product_id);
    }

    public function productData()
    {
        return $this->product->anyData();
    }

    public function changeStatus($product_id)
    {
        return $this->product->changeStatus($product_id);
    }

    public function undo_delete_product($product_id)
    {
        return $this->product->undo_delete_product($product_id);
    }

    public function productMerchantData()
    {
        return $this->product->productMerchantData();
    }

    //
    //    public function edit($id)
    //    {
    //        if (auth()->guard('admin')->user()->type == 'merchant') {
    //
    //            $store = Store::with('Categories')->where('merchant_id', auth()->guard('admin')->user()->user_id)->first();
    //            if (isset($store)) {
    //                $product = Product::with('Customizations')->where('store_id', $store->id)->find($id);
    //                $categories = $store->Categories()->get();
    //            }
    //
    //        } else {
    //            $product = Product::with('Customizations')->find($id);
    //            $categories = ProductCategory::all();
    //
    //        }
    //        $html = 'This product does not exist';
    //        if (isset($product)) {
    //
    //            $data = [
    //                'main_title' => 'Edit product',
    //                'icon' => 'fa fa-edit',
    //                'product' => $product,
    //                'categories' => $categories,
    //                'customizations' => Customization::all()
    //            ];
    //            $view = view()->make('merchant.partial.edit-product', $data);
    //
    //            $html = $view->render();
    //        }
    //        return $html;
    //    }
    public function edit($id)
    {

        if (auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin") {

            $product = Product::find($id);
            $store = Store::with('Categories')->where('merchant_id', $product->merchant_id)->first();
            $categories = ProductCategory::where('store_id',  $product->merchant_id);
        } else {
            $store = Store::with('Categories')->where('merchant_id', auth()->guard('admin')->user()->user_id)->first();
            $categories = ProductCategory::where('store_id',  auth()->guard('admin')->user()->user_id);
            $product = Product::where('is_active', 1)->where('merchant_id', auth()->guard('admin')->user()->user_id)->find($id);
        }
        if (!isset($product)) return redirect()->back();
        $product->custom = Customization::where('product_id', $product->id)->get();
        $data = [
            'main_title' => 'Edit product',
            'icon' => 'fa fa-edit',
            'categories' => $categories->get(),
            'product' => $product,
            'customizations' => Customization::all(),
        ];
        return view(merchant_vw() . '.products.edit', $data);
    }

    public function productImagesEdit($id)
    {
        $product = Product::with('Customizations')->find($id);
        //        dd($product->Customizations[0]->pivot);
        $html = 'This product does not exist';
        if (isset($product)) {

            $data = [
                'main_title' => 'Edit product',
                'icon' => 'fa fa-edit',
                'product' => $product,
                //                'categories' => $store->Categories()->get(),
                'customizations' => Customization::all()
            ];
            if (auth()->guard('admin')->user()->type == 'merchant') {
                $view = view()->make('merchant.partial.product-images', $data);
            } else {
                $view = view()->make('merchant.partial.product-images-view', $data);
            }
            $html = $view->render();
        }
        return $html;
    }

    //
    public function update(UpdateRequest $request, $id)
    {
        return $this->product->update($request->all(), $id);
    }

    public function create($id = null)
    {
        $store = Store::with('Categories')->where('merchant_id', is_null($id) ?  auth()->guard('admin')->user()->user_id : $id)->first();
        $categories = ProductCategory::where('store_id',  auth()->guard('admin')->user()->user_id);


        $data = [
            'id' => $id,
            'main_title' => 'Add new product',
            'icon' => 'fa fa-plus',
            'categories' => $categories->get(),
            'customizations' => Customization::all()
        ];
        return view(merchant_vw() . '.products.create', $data);
    }

    public function store(CreateRequest $request, $Mid = null)
    {
        // if (isset($id))
        //     return $this->product->update($request->all(), $id);
        return $this->product->create($request->all(), $Mid);
    }

    public function delete($id)
    {
        return $this->product->delete($id);
    }

    public function setSponsor(Request $request)
    {
        return $this->product->setSponsor($request->only('product_id'));
    }

    public function setOffer(Request $request)
    {
        return $this->product->setOffer($request->only('product_id'));
    }


    public function productImages(Request $request, $product_id)
    {
        return $this->product->productImages($request->all(), $product_id);
    }

    public function getProductImages($product_id)
    {
        $files = ProductImage::where('product_id', $product_id)->get();
        return response()->json(['files' => $files]);
    }

    public function deleteProductImage($id)
    {
        return $this->product->deleteProductImage($id);
    }
}
