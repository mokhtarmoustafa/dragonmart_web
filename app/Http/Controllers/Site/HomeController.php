<?php

namespace App\Http\Controllers\Site;

use App\General;
use App\Http\Requests\Api\Home\FilterRequest;
use App\Repositories\Eloquents\AboutEloquent;
use App\Repositories\Eloquents\AdvertisementEloquent;
use App\Repositories\Eloquents\HomeEloquent;
use App\Repositories\Eloquents\UserEloquent;
use App\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CityEloquent;

class HomeController extends Controller
{
    //
    private $home;
    private $city;
    private $ad;
    private $about;
    private $user;

    public function __construct(HomeEloquent $homeEloquent, AboutEloquent $aboutEloquent, CityEloquent $city, AdvertisementEloquent $advertisementEloquent , UserEloquent $userEloquent)
    {
        parent::__construct();
        $this->home = $homeEloquent;
        $this->city = $city;
        $this->ad = $advertisementEloquent;
        $this->about = $aboutEloquent;
        $this->user = $userEloquent;
    }

    public function index()
    {

        $data = $this->home->getUserHome([]);
        $data['ads'] = $this->ad->getAll([]);
        $data['always_open'] = 'always-open';//\'\' => \'\'';
        $data['merchants'] = $this->user->getMerchants(array());

        return view(site_vw() . '.home', $data);
    }




    public function about()
    {
        $data = [
            'abouts'=>$this->about->getAll([])
        ];
        return view(site_vw() . '.about', $data);
    }

    public function term()
    {
        $data = [
            'term' => Terms::where('type', 'term')->first()
        ];
        return view('site.term', $data);
    }

    public function policy()
    {
        $data = [
            'policy' => Terms::where('type', 'policy')->first()
        ];
        return view('site.policy', $data);
    }

    public function contact()
    {
        $data = [

        ];
        return view(site_vw() . '.contact', $data);
    }


    public function cities()
    {
        return $this->city->getCities([]);
    }
}
