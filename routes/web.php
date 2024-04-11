<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Season;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("auth")->group(function(){
    Route::get('/', function () {
        $courses = Course::all();
        return view('welcome',compact("courses"));
    })->name("home");

    Route::delete("/seasons/{id}",[SeasonController::class,"destroy"])->name("seasons.destroy");
    Route::post("/seasons",[SeasonController::class,"store"])->name("seasons.store");
    Route::get("/subseasons/create/{id}",[SeasonController::class,"createsub"])->name("seasons.sub.create");
    Route::post("/subseasons/store",[SeasonController::class,"storesub"])->name("seasons.sub.store");
    Route::get("/season/{id}",[SeasonController::class,"create"])->name("seasons.create");
    Route::get("/seasons/{id}",[SeasonController::class,"index"])->name("seasons.index");
    Route::resource("/users",UserController::class)->names("users");
    Route::resource("/articles",ArticleController::class)->names("articles");
    Route::resource("/sliders",SliderController::class)->names("sliders");
    Route::resource("/courses",CourseController::class)->names("courses");
    Route::resource("/episodes",EpisodeController::class)->names("episodes");
    Route::resource("/comment",CommentsController::class)->names("comment");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix("api")->group(function(){
    Route::post("/login",[ApiController::class,"login"]);
    Route::post("/user/update",[ApiController::class,"updateuser"]);
    Route::get("/home",[ApiController::class,"home"]);
    Route::get("/version",[ApiController::class,"getversion"]);
    Route::post("/single",[ApiController::class,"getcourse"]);
    Route::post("/cart",[ApiController::class,"createcart"]);
    Route::post("/cart/check",[ApiController::class,"checkcart"]);
    Route::post("/cart/delete",[ApiController::class,"deletecart"]);
    Route::post("/hashcheck",[ApiController::class,"check_hash"]);
    Route::post("/Kobs",[ApiController::class,"kobs"]);
    Route::post("/mycourse",[ApiController::class,"mycourse"]);
    Route::post("/license",[ApiController::class,"getlicense"]);
    Route::get("/articles",[ApiController::class,"getarticles"]);
    Route::post("/comment/create",[ApiController::class,"commentcreate"]);
    Route::post("/comments",[ApiController::class,"getcomments"]);
    Route::post("/check_code",[ApiController::class,"check_code"]);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
