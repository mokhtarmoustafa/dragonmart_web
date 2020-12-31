<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\PromotionCode;
use App\Admin;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class PromotionCodeEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(PromotionCode $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        if (getAuth()->type == 'merchant')
            $promotion_codes = $this->model->where('merchant_id', getAuth()->user_id)->orderByDesc('created_at');
        else
            $promotion_codes = $this->model->orderByDesc('created_at');
            
            
        return datatables()->of($promotion_codes)
            ->filter(function ($query) {
            })->addColumn('created_by', function ($promotion_codes) {
                if (isset($promotion_codes->merchant_id))
                    return $promotion_codes->merchant->username;
                return 'Dragon Mart';
            })->editColumn('status', function ($promotion_codes) {
                if (getAuth()->type == 'merchant') {
                    if ($promotion_codes->status)
                        return '<span class="badge badge-success">Approved</span>';
                    return '<span class="badge badge-warning">Waiting For Approval</span>';

                }
                if ($promotion_codes->status)
                    return '<input type="checkbox" class="make-switch status" name="status" data-id="' . $promotion_codes->id . '" checked data-on-color="success" data-size="mini" data-off-color="warning">';
                return '<input type="checkbox" class="make-switch status" name="status" data-id="' . $promotion_codes->id . '" data-on-color="success" data-size="mini" data-off-color="warning">';
            })->addColumn('action', function ($promotion_codes) {
                return '<a href="' . url(admin_promotion_tab_url() . '/' . $promotion_codes->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-promotion-mdla ajax-modal" title="Edit" data-size="modal-xl">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_promotion_tab_url() . '/delete/' . $promotion_codes->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['status', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        $ads = $this->model->where("status" , "1")->orderByDesc('created_at')->take(4)->get();
        return $ads;
    }

    function getadvs(array $attributes)
    {
        // $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        // $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        $collection = $this->model->where('status', 1)->get();

        // $count = $collection->count();
        // $page_count = page_count($count, $page_size);
        // $page_number = $page_number - 1;
        // $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
        // $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();
        // $object = $collection->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            if (count($collection) > 0)
                return response_api(true, 200, null, $collection);
            return response_api(true, 200, null, []);
        }
        return $collection;

    }


    function getById($id)
    {
        return $this->model->find($id);

    }

    function approve($id)
    {

        $promotion_code = $this->model->find($id['promotion_code_id']);

        if (isset($promotion_code)) {
            $promotion_code->status = !$promotion_code->status;

            if ($promotion_code->save()) {
                return response_api(true, 200, null, $promotion_code);
            }
        }
        return response_api(false, 422);

    }


    function create(array $attributes)
    {
        $promotion_code = new PromotionCode();
        $promotion_code->code = $attributes['code'];
        $promotion_code->description = $attributes['description'];
        $promotion_code->action = json_encode($attributes['action']);
        if (getAuth()->type == 'admin')
            $promotion_code->status = 1;
        else
            $promotion_code->merchant_id = getAuth()->user_id;

        if ($promotion_code->save()) {
            return response_api(true, 200, null, $promotion_code);
        }
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.
        $promotion_code = PromotionCode::find($id);
        $promotion_code->code = $attributes['code'];
        $promotion_code->description = $attributes['description'];
        $promotion_code->action = json_encode($attributes['action']);
        if ($promotion_code->save()) {
            return response_api(true, 200, null, $promotion_code);
        }
        return response_api(false, 422, null, []);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $promotion_code = $this->model->find($id);
        if (isset($promotion_code) && $promotion_code->delete()) {
            return response_api(true, 200, null, []);
        }
        return response_api(false, 422, null, []);

    }
}
