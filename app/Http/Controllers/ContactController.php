<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\Api\Contact\ReplyRequest;
use App\Mail\ReplyContactMail;
use App\Repositories\Eloquents\ContactEloquent;
use Illuminate\Http\Request;
use Mail;
use Snowfire\Beautymail\Beautymail;

class ContactController extends Controller
{
    //

    private $contact;

    public function __construct(ContactEloquent $contactEloquent)
    {
        parent::__construct();
        $this->contact = $contactEloquent;
    }

    // Begin contact operation
    public function contacts()
    {
        Contact::where('seen', 0)->update(['seen' => 1]);
        $data = [
            'main_title' => 'Contacts',
            'icon' => 'icon-call-in',
        ];
        return view(admin_vw() . '.contacts.index', $data);
    }

//
    public function anyData()
    {
        return $this->contact->anyData();
    }

    public function reply(ReplyRequest $request, $id)
    {
        $contact = Contact::find($id);

        if (!isset($contact))
            return response_api(false, 422, null, []);
        $beautymail = app()->make(Beautymail::class, ['settings' => null]);

        $contact->is_reply = 1;
        $contact->save();
        $contact->reply = $request->get('message');
        $beautymail->send('emails.reply_contact', ['contact' => $contact], function ($message) use ($contact) {
            $message
                ->from('info@macrotop.website')
                ->to($contact->email, 'Dragonmart')
                ->subject('Reply Contact Dragonmart!');
        });
        return response_api(true, 200, null, []);
    }

}
