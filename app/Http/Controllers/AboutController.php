<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\About\CreateRequest;
use App\Http\Requests\Admin\About\UpdateRequest;
use App\Repositories\Eloquents\AboutEloquent;
use App\Repositories\Eloquents\AdvertisementEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    //

    private $about;

    public function __construct(AboutEloquent $aboutEloquent)
    {
        $this->about = $aboutEloquent;
    }

    public function index()
    {
        $data = [
            'abouts' => $this->about->getAll([])
        ];
        return view(admin_vw() . '.abouts.index', $data);
    }


    public function anyData()
    {
        return $this->about->anyData();
    }
//
//    public function create()
//    {
//        $view = view()->make(modals('abouts.add'), [
//        ]);
//
//        $html = $view->render();
//
//        return $html;
//    }
    public function create()
    {
        $data = [
            'abouts' => $this->about->getAll([])
        ];
        return view(admin_vw() . '.abouts.add', $data);
    }

//    public function edit($id)
////    {
////        $about = $this->about->getById($id);
////
////        $html = 'This about does not exist';
////        if (isset($about)) {
////            $view = view()->make(modals('abouts.edit'), [
////                'about' => $about
////            ]);
////
////            $html = $view->render();
////        }
////        return $html;
////    }
    public function edit($id)
    {
        $about = $this->about->getById($id);

        $data = [
            'about' => $about
        ];
        return view(admin_vw() . '.abouts.edit', $data);
    }


//    public function order(Request $request)
//    {
//        $request->request->add(['page' => 'about_us']);
//        return $this->about->order($request->all());
//    }

    public function store(CreateRequest $request)
    {
        return $this->about->create($request->all());
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->about->update($request->all(), $id);

    }

//    public function changeStatus($id)
//    {
//        return $this->about->changeStatus($id);
//
//    }

    public function delete($id)
    {
        return $this->about->delete($id);

    }
}
