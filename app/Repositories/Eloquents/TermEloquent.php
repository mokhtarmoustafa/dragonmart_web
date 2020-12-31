<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\term;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Terms;

class TermEloquent implements Repository
{

    private $model;

    public $appends = [];

    public function __construct(Terms $model)
    {
        $this->model = $model;
    }

    function anyData()
    {
        $terms = $this->model->orderByDesc('created_at');
        return datatables()->of($terms)
            ->filter(function ($query) {

            })
            ->addColumn('action', function ($term) {
                return '<a href="' . url(admin_terms_url() . '/' . $term->id . '/edit') . '" target="_blank" class="btn btn-circle btn-icon-only purple edit-term-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['media', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->orderByDesc('created_at')->get();
    }

    function updatePolicy(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $policy = $this->model->where('type', 'policy')->first();

        $policy->title_ar = $attributes['title_ar'];
        $policy->title_en = $attributes['title_en'];
        $policy->desc_ar = $attributes['desc_ar'];
        $policy->desc_en = $attributes['desc_en'];
        if ($policy->save())
            return response_api(true, 200, trans('app.updated'));
        return response_api(false, 422);
    }

    function updateTerm(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $term = $this->model->where('type', 'term')->first();

        $term->title_ar = $attributes['title_ar'];
        $term->title_en = $attributes['title_en'];
        $term->desc_ar = $attributes['desc_ar'];
        $term->desc_en = $attributes['desc_en'];
        if ($term->save())
            return response_api(true, 200, trans('app.updated'));
        return response_api(false, 422);
    }

    function getById($id)
    {
        return $this->model->find($id);
    }

    function create(array $attributes)
    {
    }

    function update(array $attributes, $id = null)
    {
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $term = $this->model->find($id);

        if (isset($term) && $term->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

}
