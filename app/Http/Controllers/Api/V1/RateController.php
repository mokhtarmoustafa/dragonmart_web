<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Rate\CreateRateRequest;
use App\Repositories\Eloquents\RateEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    //
    private $rate;

    public function __construct(RateEloquent $rateEloquent)
    {
        $this->rate = $rateEloquent;
    }

    public function postRate(CreateRateRequest $request){

        if ($request->has('type') && $request->get('type') == 'service'){
            return $this->rate->rateService($request->all());
        }
        return $this->rate->create($request->all());
    }
}
