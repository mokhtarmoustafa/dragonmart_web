<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Ad\CreateRequest;
use App\Http\Requests\Admin\Ad\UpdateRequest;
use App\Repositories\Eloquents\AdvertisementEloquent;
use Illuminate\Http\Request;
use App\ProductCategory;


class AdvertisementController extends Controller
{
    //
    private $adv;

    public function __construct(AdvertisementEloquent $advertisementEloquent)
    {
        parent::__construct();
        $this->adv = $advertisementEloquent;
    }

    // Begin  operation
    public function index()
    {

        $data = [
            'main_title' => 'Advertisement',
            'icon' => 'icon-feed',
        ];

        if (getAuth()->type == 'admin')
            return view(admin_vw() . '.advertisements.index', $data);
        return view(merchant_vw() . '.advertisements.index', $data);
    }

    public function anyData()
    {
        return $this->adv->anyData();
    }

    //
    public function edit($id)
    {

        $ad = $this->adv->getById($id);

        $html = 'This Ad does not exist';
        if (isset($ad)) {

            $view = view()->make('modal', [
                'modal_id' => 'edit-ad',
                'modal_title' => 'Edit Ad',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_adv_tab_url() . '/' . $id . '/edit'),
                    'form_id' => 'formEdit',

                    'fields' => [
                        'image' => 'image',
                        'url' => 'text',

                    ],
                    'values' => [
                        'image' => $ad->image,
                        'url' => $ad->url,
                    ],

                    'fields_name' => [
                        'image' => 'Image',
                        'url' => 'url',

                    ]
                ]
            ]);

            $html = $view->render();
            $categories = ProductCategory::whereNull('store_id')->get();
            
            return view(admin_adv_tab_url() . '.modal.edit', compact('categories' , 'ad'));

        }
        return $html;
    }

//
    public function update(UpdateRequest $request, $id)
    {
        return $this->adv->update($request->all(), $id);
    }

//
    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-ad',
            'modal_title' => 'Add new Ad.',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_adv_tab_url() . '/create'),
                'form_id' => 'formAdd',
                'fields' => [
                    'image' => 'image',
                    'url' => 'text',
                    'action' => 'select',

                ],
                'fields_name' => [
                    'image' => 'Image',
                    'url' => 'url',
                    'action' => 'action',

                ]
            ]
        ]);

        $html = $view->render();

        // return $html;
        
        if(getAuth()->type == "merchant")
          $categories = ProductCategory::where('store_id' , getAuth()->user_id)->get();
        else
          $categories = [];
        
        return view(admin_adv_tab_url() . '.modal.create', compact('categories'));

    }

//
    public function store(CreateRequest $request)
    {
        return $this->adv->create($request->all());
    }

    public function approve(Request $request)
    {
        return $this->adv->approve($request->only('adv_id'));
    }

    public function delete($id)
    {
        return $this->adv->delete($id);
    }

}
