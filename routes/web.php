<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout']);

// https://laravel.com/docs/9.x/verification#main-content
// 1. Route that serves the view that says the user's email is not verified
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. Route that handles verification itself
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    // flas toast_message to session on the login page
    return redirect('/login')->with('toast_message', "Email succesfully verified");
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. Route that handles resending email - submit to this link can be contained within the blade that says the user is not verified
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    // flash 'message' key to session when redirecting back to the not verified page
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// You can register routes with the FQCN@method or with an array [controller class, method name]
Route::get('/teams', 'App\Http\Controllers\TeamController@index');
Route::get('/teams/{team}', 'App\Http\Controllers\TeamController@show');
Route::post('/teams/{team}/comments', 'App\Http\Controllers\CommentController@store');
Route::get('/players/{player}', 'App\Http\Controllers\PlayerController@show');
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/create', [NewsController::class, 'create']);
Route::post('/news/create', [NewsController::class, 'store']);
Route::get('/news/{news}', [NewsController::class, 'show']); // /news/create mora biti prva jer ce /news/{create} prva da se mecuje ako je iznad nje
