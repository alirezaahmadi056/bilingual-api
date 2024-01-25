<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Melipayamak\MelipayamakApi;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where("phone", $request->phone)->get();
        if ($user[0]) {
            $code = random_int(100000,999999);
            //GitHub نمونه کدهای
            $username = '9120280085';
            $password = 'c71f8e9';
            $api = new MelipayamakApi($username, $password);
            $sms = $api->sms();
            $to = $user[0]->phone;
            $from = '50004001280085';
            $text = "کد ورود:$code";
            $response = $sms->send($to, $from, $text);
            $json = json_decode($response);

            return response()->json([
                "id" => $user[0]->id,
                "result" => $json->Value,
                "code" => $code
            ]);
        }else{
            return abort(404);
        }
    }
}
