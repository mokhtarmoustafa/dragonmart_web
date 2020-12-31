<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\ServiceEloquent;
use App\Repositories\Eloquents\CategoryEloquent;
use App\Repositories\Eloquents\UserEloquent;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Service\SendRequest;

use App\Http\Requests\Api\Service\CreateServicesRequest;
use App\Http\Requests\Api\Service\UpdateServiceRequest;


class ServiceController extends Controller
{
    private $service;
    private $category;
    private $user ;

    public function __construct(  ServiceEloquent $serviceEloquent
                                 ,CategoryEloquent $categoryEloquent
                                 ,UserEloquent $userEloquent

                                )
    {
        parent::__construct();

        $this->service = $serviceEloquent;
        $this->category = $categoryEloquent;
        $this->user = $userEloquent;
    }

    public function list()
    {

         $services = $this->category->getProviderCategories([]);
         return view(site_vw() . '.services.list' , compact('services'));
    }

    public function service_providers_list($id , $pagesize =10 , $currentpage =1)
    {

        $m['page_size'] = $pagesize ;
        $m['page_number'] = $currentpage ;
        $m['category_id']= $id ;
        $service =  $this->category->getByIdCategory($id);
        $providers =  $this->user->getServiceProviders($m);

      //  dd($providers );

        return view(site_vw() . '.services.service-providers',compact('providers' , 'service'));
    }


    public function service_provider_profile()
    {
        return view(site_vw() . '.services.profile');
    }

    public function service_provider_profile_view( $provider_id , $service_id)
    {
        $r['category_id']= $service_id ;
        $r['service_provider_id']= $provider_id;


        $services = $this->service->getServices($r);
        $provider =  $this->user->getById($provider_id);
        $user = Auth::user();


        return view(site_vw() . '.services.profile-view', compact('services' , 'provider' ,'user'));
    }


    public function sendRequest(Request $request)
    {


        if(!Auth::user()){
            $m2 = $request->url;
            $m2 = url( site_url().'/login?redirectpage='.$request->url );
            return  response(['status' => false , 'redirect' => $m2]);
        }
        return $this->service->sendRequest($request->all());
    }

    public function addService(Request $request)
    {

        $arr['text'] = $request->service_name;
        $arr['price'] = $request->service_price;
        $arr['category_id'] = $request->service_type;
      // dd();
        return $this->service->create($arr);
    }

    public function deleteService($id){
      //  dd($id);
        return $this->service->delete($id);
    }


    public  function editService(Request $request , $id){

        $arr['text'] = $request->service_name;
        $arr['price'] = $request->service_price;
        $arr['category_id'] = $request->service_type;

        return $this->service->update($arr , $id);

    }



}
