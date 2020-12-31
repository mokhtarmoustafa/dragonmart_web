<?php

namespace App\Http\Controllers;

use App\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeepLinkController extends Controller
{
    //

    public function redirectDeepLink($id)
    {


        try {
            $device = $this->isMobileDevice();
            $user = \App\User::find($id);

            if (!isset($user) || $user->is_reset_password){
                return redirect('https://www.google.com/');
            }
            if ($user->type == 'driver')
                $app = 'dragonmartdriver://user/' . $id;//dragonmartdriver
            else
                $app = 'dragonmart://user/' . $id;

            $data = array();
            if ($device == 'iPhone') {
                $data['primaryRedirection'] = $app;
                $data['secndaryRedirection'] = 'https://www.google.com/';
            } else if ($device == 'Android') {
                $data['primaryRedirection'] = $app;
                $data['secndaryRedirection'] = 'https://www.google.com/';
            }

//            else {
//                return $this->getProduct($id);
//            }
            return view('emails.deep_link', $data);
        } catch (\Exception $e) {
//            return $this->getProduct($id);

            Log::error(__METHOD__ . ' ' . $e->getMessage());
//            return Utilities::responseError(__('messages.SOMETHING_WENT_WRONG') . $e->getMessage());
        }
    }

    private function isMobileDevice()
    {
        $aMobileUA = array(
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
        );
        //Return true if Mobile User Agent is detected
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {

            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
                return $sMobileOS;
            }
        }
        //Otherwise return false..
        return false;
    }

}
