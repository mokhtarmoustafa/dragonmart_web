<?php

namespace App\Http\Controllers\Site;

use App\Repositories\Eloquents\CategoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\UserEloquent;
use App\Http\Requests\Api\Product\GetProductsRequest;
use App\Repositories\Eloquents\ProductEloquent;
use App\ProductCategory;
use App\Product;

class MerchantController extends Controller
{
    //
    private $user;
    private $category;

    public function __construct(UserEloquent $userEloquent, ProductEloquent $productEloquent, CategoryEloquent $categoryEloquent)
    {
        parent::__construct();
        $this->user = $userEloquent;
        $this->product = $productEloquent;
        $this->category = $categoryEloquent;

    }

    public function list(Request $request)
    {
        // dd($request->all());
        $parameters = \Request::query();

        //dd($parameters );
        $querystrint = http_build_query($parameters);

        if (strpos($querystrint, 'page_size') !== false) {
            $m['page_size'] = $request->page_size;
        } else {
            $request->merge(['page_size' => 10]);

        }

        if (strpos($querystrint, 'page_number') !== false) {
            $m['page_number'] = $request->page_number;
        } else {
            $request->merge(['page_number' => 1]);

        }


        // dd($request->all());


        if (isset($request->city) && $request->city > 0) {
            $m['city_id'] = $request->city;
        }

        if (isset($request->min_price_filter)) {
            $m['price_from'] = $request->min_price_filter;
        }

        if (isset($request->max_price_filter)) {
            $m['price_to'] = $request->max_price_filter;
        }

        if (isset($request->max_near_filter)) {
            $m['max_near_filter'] = $request->max_near_filter;
        }

        if (isset($request->min_near_filter)) {
            $m['min_near_filter'] = $request->min_near_filter;
        }

        if (isset($request->merchan_filter)) {
            $m['merchant_ids'] = $request->merchan_filter;
        }

        if (isset($request->categories_filter)) {
            $m['categories_ids'] = $request->categories_filter;
        }

        if (isset($request->page_size)) {
            $m['page_size'] = $request->page_size;
        } else {
            $m['page_size'] = 3;
        }
        if (isset($request->page_number)) {
            $m['page_number'] = $request->page_number;
        } else {
            $m['page_number'] = 1;
        }

        $merchants = $this->user->getMerchants($m);
        // dd()
        return view(site_vw() . '.merchants.list', compact('merchants'));
    }

    public function merchantPage($merchant_id, $pagesize = 10, $currentpage = 1)
    {


        $parameters = \Request::query();
        $request = request();
        $querystrint = http_build_query($parameters);

        if (strpos($querystrint, 'page_size') !== false) {
            $m['page_size'] = request()->page_size;
        } else {
            $request->merge(['page_size' => 10]);

        }

        if (strpos($querystrint, 'page_number') !== false) {
            $m['page_number'] = $request->page_number;
        } else {
            $request->merge(['page_number' => 1]);

        }


        if (isset($request->city) && $request->city > 0) {
            $m['city_id'] = $request->city;
        }

        if (isset($request->min_price_filter)) {
            $m['price_from'] = $request->min_price_filter;
        }

        if (isset($request->max_price_filter)) {
            $m['price_to'] = $request->max_price_filter;
        }

        if (isset($request->max_near_filter)) {
            $m['max_near_filter'] = $request->max_near_filter;
        }

        if (isset($request->min_near_filter)) {
            $m['min_near_filter'] = $request->min_near_filter;
        }

        if (isset($request->merchan_filter)) {
            $m['merchant_ids'] = $request->merchan_filter;
        }

        if (isset($request->categories_filter)) {
            $m['categories_ids'] = $request->categories_filter;
        }

        if (isset($request->page_size)) {
            $m['page_size'] = $request->page_size;
        } else {
            $m['page_size'] = 10;
        }
        if (isset($request->page_number)) {
            $m['page_number'] = $request->page_number;
        } else {
            $m['page_number'] = 1;
        }

        $arr['merchant_id'] = $merchant_id;

        $merchant = $this->user->getMerchant($arr);
        if (count($merchant) == 0) return redirect()->back();
            $merchant = $merchant[0];
        $m['merchant_id'] = $merchant_id;





        $Cats =  ProductCategory::where('product_categories.store_id',  $merchant->id)
        ->whereNull('product_categories.deleted_at')
        ->select(['product_categories.id', 'product_categories.name' , 'product_categories.name_ar'])
        ->orderByRaw('-order_by DESC')
        ->orderByDesc('product_categories.created_at')->get();

        $remove_cat  = array();

        foreach($Cats as $key => $Cat){
             $Product = Product::whereNull('deleted_at')->where('category_id',  $Cat->id)->orderByDesc('created_at')->get(['id' , 'name' , 'price' , 'available_quantity' , 'merchant_id']);

             if(count($Product) > 0){
                 $Cats[$key]['Products'] = $Product;

             }else {
                //  array_push($remove_cat , $key);
             }

        }

        // foreach($remove_cat as $key => $id){
        //     unset($Cats[$id]);
        //     $Cats = array_values($Cats);
        // }

        $merchant['Storecat']= $Cats;





        $products = $this->product->getProducts($m);

        $merchant->products = $products;

        $categories = Categories()->where("store_id" , $merchant->id);

        // dd($merchant[0]->products);
        return view(site_vw() . '.merchants.merchant-page', compact('merchant', 'categories'));
    }


    public function getCategoryMerchant($id)
    {


        // dd($request->all());
        $parameters = \Request::query();

        $request = request();
        $querystrint = http_build_query($parameters);

        if (strpos($querystrint, 'page_size') !== false) {
            $m['page_size'] = request()->page_size;
        } else {
            $request->merge(['page_size' => 10]);

        }

        if (strpos($querystrint, 'page_number') !== false) {
            $m['page_number'] = $request->page_number;
        } else {
            $request->merge(['page_number' => 1]);

        }


        if (isset($request->city) && $request->city > 0) {
            $m['city_id'] = $request->city;
        }

        if (isset($request->min_price_filter)) {
            $m['price_from'] = $request->min_price_filter;
        }

        if (isset($request->max_price_filter)) {
            $m['price_to'] = $request->max_price_filter;
        }

        if (isset($request->max_near_filter)) {
            $m['max_near_filter'] = $request->max_near_filter;
        }

        if (isset($request->min_near_filter)) {
            $m['min_near_filter'] = $request->min_near_filter;
        }

        if (isset($request->merchan_filter)) {
            $m['merchant_ids'] = $request->merchan_filter;
        }

        if (isset($request->categories_filter)) {
            $m['categories_ids'] = $request->categories_filter;
        }

        if (isset($request->page_size)) {
            $m['page_size'] = $request->page_size;
        } else {
            $m['page_size'] = 10;
        }
        if (isset($request->page_number)) {
            $m['page_number'] = $request->page_number;
        } else {
            $m['page_number'] = 1;
        }


        $m['category_id'] = $id;

//        dd($m);
        $merchants = $this->user->getMerchants($m);
        $category = $this->category->getById($id);

        //  dd($category );

        //$category = Categ

        return view(site_vw() . '.merchants.list', compact('merchants', 'category'));
    }


}
