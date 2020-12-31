<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\PaymentEloquent;
use Damas\Paytabs\paytabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PaymentController extends Controller
{
    //
    private $payment;

    public function __construct(PaymentEloquent $paymentEloquent)
    {
        parent::__construct();
        $this->payment = $paymentEloquent;
    }

    public function resultPayNow(Request $request)
    {
        $pt = Paytabs::getInstance('info@directiongoals.com', 'VzQbRYgrq2gvMeuuNnyo31Ld7ZtHmiMhRCtJBJa1MrxyF13spCRsDCGKCarYsdfkQJ4rseteF0Nl2QNrsFU5hBQULhSev8zlRDNj');
        $result = $pt->verify_payment($request->payment_reference);

        if ($result->response_code == 100) {
            // Payment Success

            $this->payment->createPayment($request->payment_reference, $result);
            return redirect()->to('site/home?action=true&message=' . $result->result);
        }
        return redirect()->to('site/home?action=false&message=' . $result->result);

    }


}
