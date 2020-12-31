<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Product\GetProductsRequest;
use App\Repositories\Eloquents\ProductEloquent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    private $product;

    public function __construct(ProductEloquent $productEloquent)
    {
        $this->product = $productEloquent;
    }

    public function getProduct($product_id)
    {
        return $this->product->getById($product_id);
    }

    public function getProducts(GetProductsRequest $request)
    {
        return $this->product->getProducts($request->all());
    }
}
