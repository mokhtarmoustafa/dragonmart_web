<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Service\ChangeStatusRequest;
use App\Http\Requests\Api\Service\CreateServicesRequest;
use App\Http\Requests\Api\Service\GetReviewsRequest;
use App\Http\Requests\Api\Service\GetServiceRequestsRequest;
use App\Http\Requests\Api\Service\GetServicesRequest;
use App\Http\Requests\Api\Service\SendRequest;
use App\Http\Requests\Api\Service\UpdateServiceRequest;
use App\Repositories\Eloquents\ServiceEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    //

    private $service;

    public function __construct(ServiceEloquent $serviceEloquent)
    {
        $this->service = $serviceEloquent;
    }

    public function sendRequest(SendRequest $request)
    {
        return $this->service->sendRequest($request->all());
    }

    public function getService($service_id)
    {
        return $this->service->getById($service_id);
    }

    public function getServiceRequest($request_id)
    {
        return $this->service->getServiceRequest($request_id);
    }

    public function getServices(GetServicesRequest $request)
    {
        return $this->service->getServices($request->all());
    }

    public function getServiceRequests(GetServiceRequestsRequest $request)
    {
        return $this->service->getServiceRequests($request->all());
    }

    public function getReviews(GetReviewsRequest $request)
    {
        return $this->service->getReviews($request->all());
    }

    public function addService(CreateServicesRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function editService(UpdateServiceRequest $request,$id)
    {
        return $this->service->update($request->all(),$id);
    }

    public function deleteService($id)
    {
        return $this->service->delete($id);
    }

    public function changeStatus(ChangeStatusRequest $request)
    {
        return $this->service->changeStatus($request->all());
    }

    public function getProviderCategory()
    {
        return $this->service->getProviderCategory();
    }
}
