<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\GetProductsRequest;
use App\Repositories\Eloquents\ProductEloquent;
use App\Repositories\Eloquents\RateEloquent;

class ProductController extends Controller
{

    private  $product;
    private  $rate ;

    public function __construct(ProductEloquent $productEloquent ,RateEloquent $rateEloquent)
    {
        parent::__construct();
        $this->product = $productEloquent;
        $this->rate = $rateEloquent;
    }

    public function list($name , $cat ,$pagesize =10 , $currentpage =1)
    {

        $m['product_name'] = $name ;
        $m['page_size'] = $pagesize ;
        $m['page_number'] = $currentpage ;

        if($cat > 0){
            $m['category_id'] = $cat ;
        }



        $products = $this->product->getProducts($m);

        return view(site_vw() . '.products.list', compact('products'));
    }

    public function productPage($id)
    {
        $product = $this->product->getById($id);

        // dd($product);
        return view(site_vw() . '.products.product-page' , compact('product'));
    }


    public function getCat(){
        return view(site_vw() . '.categorylist');
    }



    public function listProducts($type){

        $parameters = \Request::query();

        $request =request() ;
        $querystrint = http_build_query( $parameters );

        if(strpos($querystrint, 'page_size') !== false){
            $m['page_size'] = request()->page_size;
        } else{
            $request->merge(['page_size' => 10]);

        }

        if(strpos($querystrint, 'page_number') !== false){
            $m['page_number'] = $request->page_number;
        } else{
            $request->merge(['page_number' => 1]);

        }


        if(isset($request->city) && $request->city > 0){
            $m['city_id'] = $request->city;
        }

        if(isset($request->min_price_filter) ){
            $m['price_from'] = $request->min_price_filter;
        }

        if(isset($request->max_price_filter) ){
            $m['price_to'] = $request->max_price_filter;
        }

        if(isset($request->max_near_filter) ){
            $m['max_near_filter'] = $request->max_near_filter;
        }

        if(isset($request->min_near_filter) ){
            $m['min_near_filter'] = $request->min_near_filter;
        }

        if(isset($request->merchan_filter) ){
            $m['merchant_ids'] =$request->merchan_filter ;
        }

        if(isset($request->categories_filter) ){
            $m['categories_ids'] = $request->categories_filter;
        }

        if(isset($request->page_size) ){
            $m['page_size'] = $request->page_size;
        }else{
            $m['page_size'] = 10;
        }
        if(isset($request->page_number) ){
            $m['page_number'] = $request->page_number;
        }else{
            $m['page_number'] = 1;
        }


        $m['type'] = $type ;
        $products = $this->product->getProducts($m);

        // dd( $products );
        return view(site_vw() . '.products.list', compact('products'));
    }


    public function sendRate(Request $request){

        if ($request->has('type') && $request->get('type') == 'service'){
            return $this->rate->rateService($request->all());
        }
        return $this->rate->create($request->all());

        // dd($request->all());
    }





}
