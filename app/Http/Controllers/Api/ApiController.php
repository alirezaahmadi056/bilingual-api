<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Seasons;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Melipayamak\MelipayamakApi;

class ApiController extends Controller
{
    public function getversion(){
        return response()->json([
            "version" => 1
        ]);
    }

    public function check_hash(Request $request){
        $user = User::findOrFail($request->id);

        if($user->hash_login == $request->hash_login){
            return response()->json("OK");
        }else{
            return abort(500);
        }
    }

    public function login(Request $request)
    {
        $user = User::where("phone", $request->phone)->get();
        $hash_login = Hash::make($request->phone);
        $account = false;

        if(isset($user[0]) && $user[0]->name == null){
            $account = true;
            $user[0]->update([
                "hash_login" => $hash_login
            ]);
        }else if($account == false){
            User::create([
                "phone" => $request->phone,
                "hash_login" => $hash_login,
            ]);
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
            "code" => strval($code),
            "account" => $account,
            "hash_login" => Hash::make($request->phone)
        ]);
    }

    public function updateuser(Request $request){
        $user = User::where("phone", $request->phone)->first();

        $user->update([
            "name" => $request->name
        ]);
    }

    public function getrules(){

    }

    public function home(){
        $courses = Course::all();
        $slider = Slider::all();
        $article = Article::all();

        return response()->json([
            "popular" => $courses,
            "courses" => $courses,
            "sliders" => $slider,
            "articles" => $article,
        ]);
    }

    public function getcourse(Request $request){
        $comments = Comment::where("course_id",$request->id)->get();
        $season = Seasons::where("course_id",$request->id)->get();
        $courses = Course::findOrFail($request->id);
        $seasons = collect($season);

        $episodes = $seasons->map(function($item){
            return $item->episodes;
        });

        $COO = $comments->map(function($item){
            return [
                "title" => $item->title,
                "description" => $item->description,
                "points" => $item->points,
                "user" => $item->user,
            ];
        });

        $result = $seasons->map(function($item){
            return [
                "title"=>$item->title,
                "course_id" => $item->course_id,
                "count_video" => $item->count_video,
            ];
        });

        return response()->json([
            "Comments" => $COO,
            "seasons" => $result,
            "courses" => $courses,
            "episodes" => $episodes,
        ]);
    }

    public function createcart(Request $request){
        $cart = Cart::create([
            "user_id" => $request->user_id,
            "course_id" => $request->course_id,
        ]);

        if($cart){
            return response()->json("OK");
        }else{
            return abort(500);
        }
    }

    public function checkcart(Request $request){
        $carts = Cart::where("user_id",$request->id)->get();
        $result = $carts->map(function($item){
            return Course::findOrFail($item->course_id);
        });

        return response()->json([
            "result" => $result
        ]);
    }
}
