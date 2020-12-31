<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Repositories\Eloquents\UserEloquent;
use Auth;
use App\Repositories\Eloquents\OrderEloquent;
use App\Repositories\Eloquents\ServiceEloquent;


class UserController extends Controller
{
    //
    private $user;
    private $order;
    private $service;
    public function __construct(UserEloquent $userEloquent  ,OrderEloquent $orderEloquent , ServiceEloquent $serviceEloquent)
    {
        parent::__construct();
        $this->user    = $userEloquent;
        $this->order   = $orderEloquent;
        $this->service = $serviceEloquent;
    }

    public function login()
    {

//        session()->forget('lang');
        return view(site_vw() . '.login');
    }

    public function profile()
    {

        $id = Auth::user()->id;
        $user = $this->user->getById($id);

        $r['status'] = 'pending' ;
        $order['pending']  = $this->order->getOrderClient($r);
        $r['status']       = 'finished' ;
        $order['finished'] = $this->order->getOrderClient($r);
        $r['status']       = 'canceled' ;
        $order['canceled'] = $this->order->getOrderClient($r);
        $user->orders      = $order;


        if( $user->type == 'service_provider' ) {

            $catsprov = $this->service->getProviderCategory();
            $catsprov = $catsprov->original['items'] ;
            $arrrr['service_provider_id']= $id;
            $services = $this->service->getServices($arrrr);


            return view(site_vw() . '.services.profile' , compact('user','catsprov' ,'services'));

        }



        return view(site_vw() . '.profile' , compact('user'));


    }

    public function userupdate(Request $request){
       return  $this->user->update($request->all());

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }


    public function sendemail(Request $request){
        return response_api(true, 200, null, []);
        // dd($request->all());
    }
}
