<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Melipayamak\MelipayamakApi;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where("phone", $request->phone)->get();
        $account = false;

        if(isset($user[0])){
            $account = true;
        }

        $code = random_int(100000, 999999);
        $username = '9120280085';
        $password = 'c71f8e9';
        $api = new MelipayamakApi($username, $password);
        $sms = $api->sms();
        $to = $request->phone;
        $from = '50004001280085';
        $text = "کد ورود:$code \r\n bilingual";
        $sms->send($to, $from, $text);

        return response()->json([
            "code" => $code,
            "account" => $account,
            "hash_login" => Hash::make($request->phone)
        ]);
    }
}
