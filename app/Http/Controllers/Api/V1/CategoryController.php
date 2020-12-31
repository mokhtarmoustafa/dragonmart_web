<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Store\CreateMerchantCategoryRequest;
use App\Repositories\Eloquents\CategoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    private $category;

    public function __construct(CategoryEloquent $categoryEloquent)
    {
        $this->category = $categoryEloquent;
    }

    public function getCategories()
    {
        return $this->category->getAll([]);
    }

    public function getProviderCategories()
    {
        return $this->category->getProviderCategories([]);
    }

    public function saveMerchantCategory(CreateMerchantCategoryRequest $request)
    {
        return $this->category->saveMerchantCategory($request->all());
    }
}
