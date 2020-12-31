<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Adv;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class AdvertisementEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Adv $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        if (getAuth()->type == 'merchant')
            $advs = $this->model->where('merchant_id', getAuth()->user_id)->orderByDesc('created_at');
        else
            $advs = $this->model->orderByDesc('created_at');
            
            
        return datatables()->of($advs)
            ->filter(function ($query) {

            })
            ->editColumn('image', function ($adv) {
                return '<img src="' . $adv->image100 . '" class="">';
            })->editColumn('url', function ($adv) {
                return '<a href="$adv->url "  target="_blank">Click URL</a>';
            })->addColumn('created_by', function ($adv) {
                if (isset($adv->merchant_id))
                    return 'ASDASD';
                return 'Admin';
            })->editColumn('status', function ($adv) {
                if (getAuth()->type == 'merchant') {
                    if ($adv->status)
                        return '<span class="badge badge-success">Approved</span>';
                    return '<span class="badge badge-warning">Waiting For Approval</span>';

                }
                if ($adv->status)
                    return '<input type="checkbox" class="make-switch status" name="status" data-id="' . $adv->id . '" checked data-on-color="success" data-size="mini" data-off-color="warning">';
                return '<input type="checkbox" class="make-switch status" name="status" data-id="' . $adv->id . '" data-on-color="success" data-size="mini" data-off-color="warning">';
            })
            ->addColumn('action', function ($adv) {
                return '<a href="' . url(admin_adv_tab_url() . '/' . $adv->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-ad-mdla ajax-modal" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_adv_tab_url() . '/delete/' . $adv->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['image', 'url', 'status', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        $ads = $this->model->where("status" , "1")->orderByDesc('created_at')->take(4)->get();
        return $ads;
    }

    function getadvs(array $attributes)
    {
//        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
//        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        $collection = $this->model->where('status', 1)->get();

//        $count = $collection->count();
//        $page_count = page_count($count, $page_size);
//        $page_number = $page_number - 1;
//        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;
//        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();
//        $object = $collection->get();

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

        $adv = $this->model->find($id['adv_id']);

        if (isset($adv)) {
            $adv->status = !$adv->status;

            if ($adv->save()) {
                return response_api(true, 200, null, $adv);
            }
        }
        return response_api(false, 422);

    }


    function create(array $attributes)
    {

        $adv = new Adv();
        $adv->action = json_encode($attributes['action']);
        if (getAuth()->type == 'admin')
            $adv->status = 1;
        else
            $adv->merchant_id = getAuth()->user_id;

        if ($adv->save()) {
            $adv->image = $this->storeImageThumb('advs', $adv->id, $attributes['image']);
            $adv->save();
            return response_api(true, 200, null, $adv);
        }
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.
        $adv = Adv::find($id);
        $adv->action = json_encode($attributes['action']);
        if ($adv->save()) {
            if (isset($attributes['image'])) {
                $adv->image = $this->storeImageThumb('advs', $adv->id, $attributes['image']);
                $adv->save();
            }
            return response_api(true, 200, null, $adv);
        }
        return response_api(false, 422, null, []);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $adv = $this->model->find($id);
        if (isset($adv) && $adv->delete()) {
            return response_api(true, 200, null, []);
        }
        return response_api(false, 422, null, []);

    }


}
