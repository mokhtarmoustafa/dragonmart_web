<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\Repository;
use App\Setting;
use Excel;

class SettingEloquent implements Repository
{

    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;

    }

    function anyData()
    {
        $settings = $this->model->all();
        return datatables()->of($settings)
            ->filter(function ($query) {

            })
            ->addColumn('action', function ($setting) {
                return '
                                    <a href="' . url(admin_constant_url() . '/' . $setting->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-setting-mdl">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    ';
            })->addIndexColumn()->rawColumns(['action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
    }

    function getById($id)
    {
        return $this->model->find($id);

    }

    function getByKey($key)
    {
        $setting = $this->model->where('key', $key)->first();
        if (request()->segment(1) == 'api')
            return response_api(true, 200, null, $setting);

        return $setting;
    }


    function create(array $attributes)
    {

    }

    function update(array $attributes, $id = null)
    {

        $setting = $this->model->find($id);

        $setting->value = $attributes['value'];
        if ($setting->save()) {
            return response_api(true, 200, trans('app.updated'), $setting);

        }
        return response_api(false, 422, trans('app.not_updated'));

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $setting = $this->model->find($id);

        if (isset($setting) && $setting->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);
    }
}
