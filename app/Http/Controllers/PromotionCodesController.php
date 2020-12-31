<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PromotionCode\CreateRequest;
use App\Http\Requests\Admin\PromotionCode\UpdateRequest;
use App\Repositories\Eloquents\PromotionCodeEloquent;
use Illuminate\Http\Request;
use App\ProductCategory;
use App\User;


class PromotionCodesController extends Controller
{
    //
    private $promotion_codes;

    public function __construct(PromotionCodeEloquent $promotion_codes)
    {
        parent::__construct();
        $this->promotion_codes = $promotion_codes;
    }

    // Begin  operation
    public function index()
    {

        $data = [
            'main_title' => 'Promotion Codes',
            'icon' => 'icon-feed',
        ];

        if (getAuth()->type == 'admin')
            return view(admin_vw() . '.promotion_codes.index', $data);
        return view(merchant_vw() . '.promotion_codes.index', $data);
    }

    public function anyData()
    {
        return $this->promotion_codes->anyData();
    }

    //
    public function edit($id)
    {

        $promotion_code = $this->promotion_codes->getById($id);

        $html = 'This Ad does not exist';
        if (isset($promotion_code)) {

            $view = view()->make('modal', [
                'modal_id' => 'edit-promotion-codes',
                'modal_title' => 'Edit Promotion Codes',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_promotion_tab_url() . '/' . $id . '/edit'),
                    'form_id' => 'formEdit',

                    'fields' => [
                        'code' => 'text',
                        'description' => 'text',

                    ],
                    'values' => [
                        'code' => $promotion_code->code,
                        'description' => $promotion_code->description,
                    ],

                    'fields_name' => [
                        'code' => 'Code',
                        'description' => 'Description',

                    ]
                ]
            ]);

            $html = $view->render();
            $dm_categories = ProductCategory::where('store_id', null)->get();
            $stores = User::where('type', 'merchant')->where('is_active', 1);
            // $categories = ProductCategory::whereNull('store_id')->get();

            return view(admin_promotion_tab_url() . '.modal.edit', compact('dm_categories', 'promotion_code', 'stores'));
        }
        return $html;
    }

    //
    public function update(UpdateRequest $request, $id)
    {
        return $this->promotion_codes->update($request->all(), $id);
    }

    //
    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add_promotion_code',
            'modal_title' => 'Add Promotion Code',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_promotion_tab_url() . '/create'),
                'form_id' => 'formAdd',
                'fields' => [
                    'code' => 'text',
                    'description' => 'text',
                    'action' => 'select',

                ],
                'fields_name' => [
                    'code' => 'Code',
                    'description' => 'Description',
                    'action' => 'action',

                ]
            ]
        ]);

        $html = $view->render();

        $dm_categories = ProductCategory::where('store_id', null)->get();
        $stores = User::where('type', 'merchant')->where('is_active', 1)->get();

        return view(admin_promotion_tab_url() . '.modal.create', compact('dm_categories', 'stores'));
    }

    //
    public function store(CreateRequest $request)
    {
        return $this->promotion_codes->create($request->all());
    }

    public function approve(Request $request)
    {
        return $this->promotion_codes->approve($request->only('promotion_code_id'));
    }

    public function delete($id)
    {
        return $this->promotion_codes->delete($id);
    }
}
