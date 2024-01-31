<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
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
    Route::post("/hashcheck",[ApiController::class,"check_hash"]);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
