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
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Melipayamak\MelipayamakApi;
use Morilog\Jalali\Jalalian;

class ApiController extends Controller
{
    public function getversion(){
        return response()->json([
            "version" => 1
        ]);
    }

    public function check_hash(Request $request){
        $user = User::where("phone",$request->phone)->first();

        if($user->hash_login == $request->hash_login){
            return response()->json([
                "name" => $user->name == null ? "" : $user->name,
                "phone" => $user->phone == null ? "" : $user->phone,
                "email" => $user->email == null ? "" : $user->email,
                "birthday" => $user->birthday == null ? "" : $user->birthday,
                "hash_login" => $user->hash_login
            ]);
        }else{
            return abort(500);
        }
    }

    public function login(Request $request)
    {
        $user = User::where("phone", $request->phone)->get();
        $hash_login = Hash::make($request->phone);
        $account = false;
        $name = "";

        if(isset($user[0])){
            $account = true;
            $name = $user[0]->name;
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
        $response = $sms->send($to, $from, $text);
        $json = json_decode($response);

        return response()->json([
            "name" => $name == null ? "" : $name,
            "code" => strval($code),
            "account" => $account,
            "hash_login" => $hash_login
        ]);
    }

    public function updateuser(Request $request){
        $user = User::where("phone", $request->phone)->first();

        if($user->hash_login == $request->hash_login){
            $user->update([
                "name" => $request->name
            ]);
            return response()->json("OK");
        }else{
            return abort(500);
        }
    }

    public function kobs(Request $request){
        $user = User::where("phone",$request->phone)->first();

        $user->update([
            "name" => $request->name,
            "email" => $request->name,
            "birthday" => $request->birthday,
        ]);

        return response()->json("OK");
    }

    public function home(){
        $course = Course::all();
        $slider = Slider::all();
        $article = Article::all();

        $articles = $article->map(function($item){
            return [
                "id" => $item->id,
                "title" => $item->title,
                "description" => $item->description,
                "image" => "https://bilingual.patrisbirjand.ir/public/article_image/".$item->image,
            ];
        });

        $pop = $course->map(function($item){
            return [
                "name" => $item->name,
                "percent" => $item->percent,
                "description" => $item->description,
                "price" => $item->price,
                "image" => "https://bilingual.patrisbirjand.ir/public/courses_image/".$item->image,
            ];
        });

        $courses = $course->map(function($item){
            return [
                "name" => $item->name,
                "percent" => "",
                "description" => $item->description,
                "price" => $item->price,
                "image" => "https://bilingual.patrisbirjand.ir/public/courses_image/".$item->image,
            ];
        });

        $sliders = $slider->map(function($item){
            return [
                "id" => $item->id,
                "link" => $item->link,
                "image" => "https://bilingual.patrisbirjand.ir/public/slider_image/".$item->image,
            ];
        });

        return response()->json([
            "popular" => $pop,
            "courses" => $courses,
            "sliders" => $sliders,
            "articles" => $articles,
        ]);
    }

    public function getcourse(Request $request){
        $user = User::where("phone",$request->phone)->first();
        $cart = Cart::where("course_id",$request->id)->where("user_id",$user->id)->where("status",1)->first();
        $season = Seasons::where("course_id",$request->id)->get();
        $courses = Course::findOrFail($request->id);
        $intro = Episode::where("season_id",$season[0]->id)->skip(0)->take(3)->get();
        $seasons = collect($season);

        $result = $seasons->map(function($item){
            $videos = Episode::where("season_id",$item->id)->get();
            return [
                "name"=>$item->title,
                "video" => $videos
            ];
        });

        return response()->json([
            "intro" => $intro,
            "name"=>$courses->name,
            "teacher_name"=>$courses->teacher_name,
            "hour"=> $courses->hour,
            "description"=>$courses->description,
            "score"=>$courses->score,
            "license"=>$cart == null ? "" : $cart->license,
            "season" => $result,
        ]);
    }

    public function createcart(Request $request){

        $course = Course::findOrFail($request->course_id);
        $user = User::findOrFail($request->user_id);

        $response = Http::withHeaders([
            '$LEVEL' => -1,
            '$API' => "ZbvmlCVJAUWUonPw6IjX6QWriQs+hQ=="
        ])->post("https://panel.spotplayer.ir/license/edit/",[
            "test" => true,
            "course" => [$course->spot_id],
            "name" => $user->name,
            "watermark" => ["texts" => [["text" => $user->phone]]]
        ]);
        $res = json_decode($response);
        $key = $res->key;

        $cart = Cart::create([
            "user_id" => $request->user_id,
            "course_id" => $request->course_id,
            "license" => $key,
        ]);


        if($cart){
            return response()->json("OK");
        }else{
            return abort(500);
        }
    }

    public function checkcart(Request $request){
        $user = User::where("phone",$request->phone)->get();
        $cart = Cart::where("user_id",$user[0]->id)->where("status",0)->get();
        $course = $cart->map(function($item){
            return Course::findOrFail($item->course_id);
        });

        $courses = $course->map(function($item){
            $car = Cart::where("course_id",$item->id)->first();
            return [
                "id" => $item->id,
                "name" => $item->name,
                "percent" => $item->percent,
                "spot_id" => $item->spot_id,
                "price" => $item->price,
                "image" => "https://bilingual.patrisbirjand.ir/public/courses_image/".$item->image,
            ];
        });

        return response()->json([
            "result" => $courses
        ]);
    }

    public function deletecart(Request $request){
        $user = User::where("phone",$request->phone)->first();
        $course = Course::findOrFail($request->id);
        $cart = Cart::where("course_id",$course->id)->where("user_id",$user->id)->first();
        $cart->delete();
        return response()->json("OK");
    }

    public function mycourse(Request $request){
        $user = User::where("phone",$request->phone)->get();
        $cart = Cart::where("user_id",$user[0]->id)->where("status",1)->get();
        $course = $cart->map(function($item){
            return Course::findOrFail($item->course_id);
        });

        $courses = $course->map(function($item){
            $car = Cart::where("course_id",$item->id)->first();
            return [
                "name" => $item->name,
                "percent" => $item->percent,
                "spot_id" => $item->spot_id,
                "hour" => $item->hour,
                "price" => $item->price,
                "image" => "https://bilingual.patrisbirjand.ir/public/courses_image/".$item->image,
            ];
        });

        return response()->json([
            "result" => $courses
        ]);
    }

    public function getlicense(Request $request){
        $use = User::where("phone",$request->phone)->first();

        if($request->hash_login == $use->hash_login){
            $user = collect($use->cart);

            $licenses = $user->map(function($item){
                $course = Course::findOrFail($item->course_id);
                return [
                    "name" => $course->name,
                    "license" => $item->license
                ];
            });

            return response()->json([
                "result" => $licenses
            ]);
        }else{
            return abort(500);
        }

    }

    public function getarticles(){
        $article = Article::all();

        $articles = $article->map(function($item){
            return [
                "id" => $item->id,
                "title" => $item->title,
                "description" => $item->description,
                "image" => "https://bilingual.patrisbirjand.ir/public/article_image/".$item->image,
            ];
        });

        return response()->json([
            "result" => $articles
        ]);
    }

    public function commentcreate(Request $request){
        $user = User::where("phone",$request->phone)->first();

        Comment::create([
            "course_id" => $request->id,
            "user_id" => $user->id,
            "title" => $user->name,
            "description" => $request->description,
            "points" => $request->score,
        ]);

        return response()->json("OK");
    }

    public function getcomments(Request $request){
        $course = Course::findOrFail($request->id);

        $comment = collect($course->comments);

        $comments = $comment->map(function($item){
            return [
                "id" => $item->id,
                "user_id" => $item->user_id,
                "course_id" => $item->course_id,
                "title" => $item->title,
                "description" => $item->description,
                "points" => $item->points,
                "created_at" => Jalalian::forge($item->created_at)->format('%B %d، %Y'),
            ];
        });

        return response()->json([
            "result" => $comments
        ]);
    }
}
