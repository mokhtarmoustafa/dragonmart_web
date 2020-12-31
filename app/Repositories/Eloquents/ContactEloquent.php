<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Contact;
use App\Product;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class ContactEloquent implements Repository
{

    private $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        $contacts = $this->model->orderByDesc('created_at');
        return datatables()->of($contacts)
            ->filter(function ($query) {

//                if (request()->filled('search')) {
//                    $search = request()->get('search');
//                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
//                }

            })
            ->editColumn('is_reply', function ($contact) {
                return ($contact->is_reply) ? '<span class="badge badge-success">Replied</span>' : '<span class="badge badge-danger">Not Reply</span>';
            })
            ->addColumn('action', function ($contact) {
                return '<a href="' . url(admin_vw() . '/reply-contact/' . $contact->id) . '" class="btn btn-circle btn-icon-only btn-info reply-contact-mdl">
                                        <i class="fa fa-reply"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['is_reply', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
    }

    function getById($id)
    {
        $contact = $this->model->find($id);

        if (isset($contact)) {
            return response_api(true, 200, null, $contact);
        }
        return response_api(false, 422, null, []);
    }

    function create(array $attributes)
    {

        $contact = new Contact();
        $contact->name = $attributes['name'];
        $contact->email = $attributes['email'];
        $contact->title = $attributes['title'];
//        $contact->phone = $attributes['phone'];
        $contact->message = $attributes['message'];
        if ($contact->save()) {
            return response_api(true, 200, null, $contact);
        }
        return response_api(false, 422, null, []);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
//        $Contact = $this->model->find($id);
//        if (isset($Contact) && $Contact->delete()) {
//            return response_api(true, 200);
//        }
//        return response_api(false, 422);

    }


}
