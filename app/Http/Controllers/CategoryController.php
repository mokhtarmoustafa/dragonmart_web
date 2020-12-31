<?php

namespace App\Http\Controllers;

use App\Http\Requests\Constant\SaveCategoryRequest;
use App\ProductCategory;
use App\ProviderCategory;
use App\Repositories\Eloquents\CategoryEloquent;
use App\StoreCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    private $category;

    public function __construct(CategoryEloquent $categoryEloquent)
    {
        parent::__construct();
        $this->category = $categoryEloquent;
    }

    // Begin category operation
    public function categories()
    {

        $data = [
            'main_title' => 'constants',
            'sub_title' => 'Categories',
            'icon' => 'icon-settings',
            'constant_name' => 'categories-data',
            'url_action' => url(current_url() . '/category'),
            'label' => ' Category',
            'placeholder' => 'category',
        ];
        return view(current_view() . '.categories', $data);
    }

    public function categoriesMerchant()
    {

        $data = [
//            'main_title' => 'Categories',
            'sub_title' => 'Categories',
            'icon' => 'fa fa-list',
        ];
        return view(current_view() . '.categories-merchant', $data);
    }

    public function categoriesData()
    {
        return $this->category->anyData();
    }

    public function anyProviderData()
    {
        return $this->category->anyProviderData();
    }

    public function categoriesMerchantData()
    {
        return $this->category->categoriesMerchantData();
    }

    public function getCategory($id)
    {
        return $this->category->getById($id);
    }

    public function deleteCategory($id)
    {
        return $this->category->delete($id);
    }

    public function restoreCategory($id)
    {
        return $this->category->restore($id);
    }

    public function deleteServiceCategory($id)
    {
        return $this->category->service_delete($id);
    }

    public function saveCategory(SaveCategoryRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->category->update($request->all(), $id);
        }
        return $this->category->create($request->all());
    }

    public function saveServiceCategory(SaveCategoryRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->category->service_update($request->all(), $id);
        }
        return $this->category->service_create($request->all());
    }

    public function postMerchantCategory(Request $request)
    {
        return $this->category->postMerchantCategory($request->all());
    }

    public function addMerchantCategory()
    {
        $category_ids = StoreCategory::where('merchant_id', auth()->guard('admin')->user()->user_id)->pluck('category_id');

        $view = view()->make('modal', [
            'modal_id' => 'add-category',
            'modal_title' => 'Add New Category',
            'form' => [
                'method' => 'POST',
                'url' => url(merchant_url() . '/category'),
                'form_id' => 'save_category_frm',
                'fields' => [
                    'category_id' => ProductCategory::whereNotIn('id', $category_ids)->get(),
                ],
                'fields_name' => [
                    'category_id' => 'Category',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }



//New

    public function addMerchantPrivateCategory()
    {
        $category_ids = StoreCategory::where('merchant_id', auth()->guard('admin')->user()->user_id)->pluck('category_id');

        $view = view()->make('modal', [
            'modal_id' => 'add-category',
            'modal_title' => 'Add New Private Category',
            'form' => [
                'method' => 'POST',
                'url' => url(merchant_url() . '/category/private'),
                'form_id' => 'save_category_frm',
                'fields' => [
                    'name_ar' => 'text',
                    'name' => 'text',
                    'order_by' => 'number',
                ],
                'fields_name' => [
                    'name_ar' => trans(lang_app_site().'.CP.Name').' (Arbic)',
                    'name' => trans(lang_app_site().'.CP.Name').' (English)',
                    'order_by' => trans(lang_app_site().'.CP.order_by'),
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

   public function postMerchantPrivateCategory(Request $request , $id = null)
    {

         if (isset($id)) {
            return $this->category->update($request->all(), $id , true);
        }
        return $this->category->create($request->all() , true);

    }


    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-category',
            'modal_title' => 'Add New Product Category',
            'form' => [
                'method' => 'POST',
                'url' => url('admin/category'),
                'form_id' => 'save_category_frm',
                'fields' => [
                    'icon' => 'image',
                    'name' => 'text',
                    'name_ar' => 'text',
                    'order_by' => 'number'
                ],
                'fields_name' => [
                    'icon' => 'Icon',
                    'name' => 'Category name (English)',
                    'name_ar' => 'Category name (Arabic)',
                    'order_by' => trans(lang_app_site().'.CP.order_by')
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);

        $html = 'This category does not exist';
        if (isset($category)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-category',
                'modal_title' => 'Edit Product Category',
                'form' => [
                    'method' => 'POST',
                    'url' => url( ((auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin") ? 'admin/category/' : merchant_url()."/category/") . $category->id),
                    'form_id' => 'save_category_frm',
                    'fields' => [
                        'icon' => 'image',
                        'name' => 'text',
                        'name_ar' => 'text',
                        'order_by' => 'number'
                    ], 'values' => [
                        'icon' => $category->icon,
                        'name' => $category->name,
                        'name_ar' => $category->name_ar,
                        'order_by' => $category->order_by
                    ],
                    'fields_name' => [
                        'icon' => 'Icon',
                        'name' => 'Category name (English)',
                        'name_ar' => 'Category name (Arabic)',
                        'type' => 'Type',
                        'order_by' => trans(lang_app_site().'.CP.order_by')
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function service_create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-category',
            'modal_title' => 'Add New Service Category',
            'form' => [
                'method' => 'POST',
                'url' => url('admin/service-category'),
                'form_id' => 'save_service_category_frm',
                'fields' => [
                    'icon' => 'image',
                    'name' => 'text',
                    'name_ar' => 'text',
                    'description' => 'textarea',
                ],
                'fields_name' => [
                    'icon' => 'Icon',
                    'name' => 'Category name (English)',
                    'name_ar' => 'Category name (Arabic)',
                    'description' => 'Description',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

    public function service_edit($id)
    {
        $category = ProviderCategory::find($id);

        $html = 'This category does not exist';
        if (isset($category)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-category',
                'modal_title' => 'Edit Service Category',
                'form' => [
                    'method' => 'POST',
                    'url' => url('admin/service-category/' . $category->id),
                    'form_id' => 'save_service_category_frm',
                    'fields' => [
                        'icon' => 'image',
                        'name' => 'text',
                        'name_ar' => 'text',
                        'description' => 'textarea',
                    ], 'values' => [
                        'icon' => $category->icon,
                        'name' => $category->name,
                        'name_ar' => $category->name_ar,
                        'description' => $category->description
                    ],
                    'fields_name' => [
                        'icon' => 'Icon',
                        'name' => 'Category name (English)',
                        'name_ar' => 'Category name (Arabic)',
                        'type' => 'Type',
                        'description' => 'Description',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }
    // End category operation

}
