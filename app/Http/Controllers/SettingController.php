<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SettingEloquent;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    private $setting;

    public function __construct(SettingEloquent $settingEloquent)
    {
        $this->setting = $settingEloquent;
        view()->share(['main_title' => 'Settings']);
    }

    public function index()
    {
        $data = [
            'title' => 'Settings',
            'icon' => 'icon-settings',
        ];
        return view(admin_settings_vw() . '.index', $data);
    }

    public function anyData()
    {
        return $this->setting->anyData();
    }

    public function edit($id)
    {

        $setting = $this->setting->getById($id);

        $html = 'This setting does not exist';
        if (isset($setting)) {

            $view = view()->make('modal', [
                'modal_id' => 'edit-setting',
                'modal_title' => 'Edit setting (<span class="badge badge-danger">' . $setting->key . '</span>)',
                'form' => [
                    'method' => 'PUT',
                    'url' => url(admin_constant_url() . '/' . $id),
                    'form_id' => 'formEdit',

                    'fields' => [
//                        'key' => 'text',
                        'value' => 'text',
                    ],
                    'values' => [
//                        'key' => $setting->key,
                        'value' => $setting->value,
                    ],
                    'fields_name' => [
//                        'key' => 'Key',
                        'value' => 'Value',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function update(Request $request, $id)
    {
        return $this->setting->update($request->all(), $id);
    }


    public function explanation()
    {
        $setting = $this->setting->getByKey('explanation');
        $data = [
            'sub_title' => 'Explanation',
            'icon' => 'fa fa-cogs',
            'setting' => $setting
        ];
        return view(admin_settings_vw() . '.explanation', $data);
    }

}
