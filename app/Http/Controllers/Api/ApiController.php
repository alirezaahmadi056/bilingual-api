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
use App\Models\Payment;
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
        $account = false;
        $code = random_int(100000, 999999);

        if(isset($user[0])){
            $account = true;
            $user[0]->update([
                "code" => $code
            ]);
        }else if($account == false){
            User::create([
                "code" => $code,
                "phone" => $request->phone
            ]);
        }

        $username = '9120280085';
        $password = 'c71f8e9';
        $api = new MelipayamakApi($username, $password);
        $sms = $api->sms('soap');
        $to = $request->phone;
        $text = array($code);
        $bodyId = 207375;
        $response = $sms->sendByBaseNumber($text, $to, $bodyId);

        if($response){
            return response()->json("OK");
        }else{
            return abort(500);
        }
    }

    public function createPayment(Request $request){
        $payment = Payment::create([
            "total" => $request->total,
            "user_id" => $request->user_id,
            "course_id" => $request->course_id,
            "is_success" => $request->is_success,
            "payment_code" => $request->code,
        ]);

        if($payment){
            return response()->json([
                "result" => "OK"
            ]);
        }
        return abort(500);
    }

    public function check_code(Request $request){
        $user = User::where("phone", $request->phone)->get();
        $hash_login = Hash::make($request->phone);
        $account = false;

        if(isset($user[0])){
            if($user[0]->name != null){
                $account = true;
            }
            $user[0]->update([
                "hash_login" => $hash_login
            ]);
        }else{
            User::create([
                "phone" => $request->phone,
                "hash_login" => $hash_login,
            ]);
        }

        if($request->code == $user[0]->code){
            return response()->json([
                "account" => $account,
                "name" => $user[0]->name == null ? "" : $user[0]->name,
                "hash_login" => $user[0]->hash_login,
                "email" => $user[0]->email == null ? "" : $user[0]->email,
                "birthday" => $user[0]->birthday == null ? "" : $user[0]->birthday
            ]);
        }else{
            return abort(500);
        }
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
            "email" => $request->email,
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
                "image" => "https://ahmadi-test-app.ir/public/article_image/".$item->image,
            ];
        });

        $pop = $course->map(function($item){
            return [
                "id" => $item->id,
                "is_pop" => $item->is_pop,
                "name" => $item->name,
                "percent" => $item->percent == null ? "" : $item->percent,
                "description" => $item->description,
                "price" => $item->price,
                "image" => "https://ahmadi-test-app.ir/public/courses_image/".$item->image,
            ];
        });

        $courses = $course->map(function($item){
            return [
                "id" => $item->id,
                "name" => $item->name,
                "percent" => $item->percent == null ? "" : $item->percent,
                "description" => $item->description,
                "price" => $item->price,
                "image" => "https://ahmadi-test-app.ir/public/courses_image/".$item->image,
            ];
        });

        $sliders = $slider->map(function($item){
            return [
                "id" => $item->id,
                "link" => $item->link,
                "image" => "https://ahmadi-test-app.ir/slider_image/".$item->image,
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
        $license = null;
        if($request->phone != null){
            $user = User::where("phone",$request->phone)->first();
            $cart = Cart::where("course_id",$request->id)->where("user_id",$user->id)->where("status",1)->first();
            if($cart){
                $license = $cart->license;
            }else{
                $license = null;
            }
        }
        $season = Seasons::where("course_id",$request->id)->get();
        $courses = Course::findOrFail($request->id);
        $intro = null;
        $intro_collect = collect($intro);
        if($season->count() > 0){
            $intro_collect = Episode::where("season_id",$season[0]->id)->skip(0)->take(3)->get();
        }
        $intro_result = $intro_collect->map(function($item){
            return [
                "id" => $item->id,
                "video" => "https://ahmadi-test-app.ir/Episodes/$item->video",
                "title" => $item->title,
                "time" => $item->time,
                "season_id" => $item->season_id,
            ];
        });
        $seasons = collect($season);

        $result = $seasons->map(function($item){
            $videos = Episode::where("season_id",$item->id)->get();
            return [
                "name"=>$item->title,
                "time" => $item->time,
                "count_video" => $videos->count(),
                "video" => $videos->map(function($video){
                    return [
                        "id" => $video->id,
                        "video" => "https://ahmadi-test-app.ir/Episodes/$video->video",
                        "title" => $video->title,
                        "time" => $video->time,
                        "season_id" => $video->season_id,
                    ];
                })
            ];
        });

        return response()->json([
            "comments" => $courses->comments,
            "intro" => $intro_result,
            "name" => $courses->name,
            "price" => $courses->price,
            "teacher_name" => $courses->teacher_name == null ? "" : $courses->teacher_name,
            "hour" => $courses->hour,
            "percent" => $courses->percent == null ? "" : $courses->percent,
            "description" => $courses->description,
            "score" => $courses->score == null ? "0" : $courses->score,
            "license" => $license == null ? "" : $license,
            "season" => $result
        ]);
    }

    public function createcart(Request $request){

        $course = Course::findOrFail($request->course_id);
        $user = User::where("phone",$request->phone)->first();

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
            "user_id" => $user->id,
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
            $total = 0;
            if($item->percent > 0){
                $percent = ($item->price * $item->percent)/100;
                $total = $item->price - $percent;
            }else{
                $total = $item->price;
            }
            return [
                "id" => $item->id,
                "name" => $item->name,
                "percent" => $item->percent,
                "spot_id" => $item->spot_id,
                "price" => $total,
                "image" => "https://ahmadi-test-app.ir/public/courses_image/".$item->image,
            ];
        });

        if($request->hash_login == $user[0]->hash_login){
            return response()->json([
                "result" => $courses,
                "total" => strval($courses->sum("price"))
            ]);
        }else{
            return abort(404);
        }
    }

    public function deletecart(Request $request){
        $user = User::where("phone",$request->phone)->first();
        $course = Course::findOrFail($request->id);
        $cart = Cart::where("course_id",$course->id)->where("user_id",$user->id)->first();
        if($course->percent > 0){
            $percent = ($course->price * $course->percent)/100;
            $total = $course->price - $percent;
        }else{
            $total = $course->price;
        }
        $cart->delete();
        return response()->json([
            "price" => $total
        ]);
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
                "id" => $item->id,
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
