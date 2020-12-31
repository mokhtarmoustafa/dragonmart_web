<?php

namespace App\Http\Controllers;

use App\Customization;
use App\Http\Requests\Constant\SaveCustomizationRequest;
use App\Repositories\Eloquents\CustomizationEloquent;

class CustomizationController extends Controller
{
    //

    private $customization;

    public function __construct(CustomizationEloquent $customizationEloquent)
    {
        parent::__construct();
        $this->customization = $customizationEloquent;
        view()->share(['main_title' => 'Settings']);

    }

    // Begin customization operation
    /*
    public function customizations()
    {
        $data = [
            'main_title' => 'constants',
            'sub_title' => 'customizations',
            'icon' => 'icon-users',
            'constant_name' => 'customizations-data',
            'url_action' => url(admin_constant_url() . '/customization'),
            'label' => ' customization',
            'placeholder' => 'customization',
        ];
        return view(admin_constants_vw() . '.index', $data);
    }

    public function customizationsData()
    {
        return $this->customization->anyData();
    }

    public function getCustomization($id)
    {
        return $this->customization->getById($id);
    }

    public function deleteCustomization($id)
    {
        return $this->customization->delete($id);
    }

    public function saveCustomization(SaveCustomizationRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->customization->update($request->only('constant_name'), $id);
        }
        return $this->customization->create($request->only('constant_name'));
    }
    */

    // Begin customization operation
    public function customizations()
    {
        $data = [
//            'main_title' => 'constants',
            'sub_title' => 'customizations',
            'icon' => 'icon-settings',
            'constant_name' => 'customizations-data',
            'url_action' => url(admin_constant_url() . '/customization'),
            'label' => ' customization',
            'placeholder' => 'customization',
        ];
        return view(admin_constants_vw() . '.customizations', $data);
    }

    public function customizationsData()
    {
        return $this->customization->anyData();
    }

    public function getCustomization($id)
    {
        return $this->customization->getById($id);
    }

    public function deleteCustomization($id)
    {
        return $this->customization->delete($id);
    }

    public function saveCustomization(SaveCustomizationRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->customization->update($request->all(), $id);
        }
        return $this->customization->create($request->all());
    }

    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-customization',
            'modal_title' => 'Add New Customization',
            'form' => [
                'method' => 'POST',
                'url' => url(admin_constant_url() . '/customization'),
                'form_id' => 'save_customization_frm',
                'fields' => [
                    'name' => 'text',
                ],
                'fields_name' => [
                    'name' => 'Customization name',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

    public function edit($id)
    {
        $customization = Customization::find($id);

        $html = 'This customization does not exist';
        if (isset($customization)) {
            $view = view()->make('modal', [
                'modal_id' => 'edit-customization',
                'modal_title' => 'Edit Customization',
                'form' => [
                    'method' => 'POST',
                    'url' => url(admin_constant_url() . '/customization/' . $customization->id),
                    'form_id' => 'save_customization_frm',
                    'fields' => [
                        'name' => 'text',
                    ], 'values' => [
                        'name' => $customization->name,
                    ],
                    'fields_name' => [
                        'name' => 'Customization name',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }
    // End customization operation

}
