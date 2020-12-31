<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\About;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class AboutEloquent extends Uploader implements Repository
{

    private $model;

    public $appends = [];

    public function __construct(About $model)
    {
        $this->model = $model;
    }

    function anyData()
    {
            $abouts = $this->model->orderByDesc('created_at');
        return datatables()->of($abouts)
            ->filter(function ($query) {

            })
            ->editColumn('media', function ($about) {
                return '<a href="'.$about->media.'" target="_blank">'.$about->media_type.'</a>';
            })
            ->addColumn('action', function ($about) {
                return '<a href="' . url(admin_abouts_url() . '/' . $about->id . '/edit') . '" target="_blank" class="btn btn-circle btn-icon-only purple" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(admin_abouts_url() . '/delete/' . $about->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns([ 'media', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->orderByDesc('created_at')->get();
    }

    function getById($id)
    {
        return $this->model->find($id);
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $about = new About();
        $about->title_ar = $attributes['title_ar'];
        $about->title_en = $attributes['title_en'];
//        $aboutertisement->type = $attributes['type'];
        $about->content_ar = $attributes['content_ar'];
        $about->content_en = $attributes['content_en'];
        if ($about->save()) {

            $mime = $attributes['media']->getMimeType();
            if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
                // process upload
                $about->media = $this->upload($attributes, 'media');
                $about->media_type = 'video';
            } else {
                $about->media = $this->storeImageThumb('abouts', $about->id, $attributes['media']);
                $about->media_type = 'image';

            }
            $about->save();
            return response_api(true, 200, trans('app.created'), []);//
        }
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.
        $about = $this->model::find($id);
        if (isset($about)) {
            $about->title_ar = $attributes['title_ar'];
            $about->title_en = $attributes['title_en'];
//            $aboutertisement->type = $attributes['type'];
            $about->content_ar = $attributes['content_ar'];
            $about->content_en = $attributes['content_en'];
            if ($about->save()) {

                if (isset($attributes['media'])) {
                    $mime = $attributes['media']->getMimeType();
                    if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") {
                        // process upload
                        $about->media = $this->upload($attributes, 'media');
                        $about->media_type = 'video';
                    } else {
                        $about->media = $this->storeImageThumb('abouts', $about->id, $attributes['media']);
                        $about->media_type = 'image';
                    }
                    $about->save();
                }
                return response_api(true, 200, trans('app.updated'), []);//
            }
            return response_api(false, 422, null, []);
        }
        return response_api(false, 422, null, []);
    }

//    function changeStatus($id)
//    {
//        // TODO: Implement delete() method.
//        $aboutertisement = $this->model->find($id);
//
//        if (isset($aboutertisement)) {
//            $aboutertisement->status = !$aboutertisement->status;
//            $aboutertisement->save();
//            return response_api(true, 200, trans('app.updated'), []);
//        }
//        return response_api(false, 422, null, []);
//
//    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $about = $this->model->find($id);

        if (isset($about) && $about->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

}
