<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Contact\CreateRequest;
use App\Repositories\Eloquents\ContactEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    private $contact;

    public function __construct(ContactEloquent $contact)
    {
        $this->contact = $contact;
    }

    public function create(CreateRequest $request)
    {
        return $this->contact->create($request->all());
    }

}
