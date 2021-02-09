<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
Route::get('/', function () {
    return view('welcome');
})->middleware(['auth']);

Route::get('logout/', function(){
    auth()->logout();
    return redirect('login/');
});

Route::get('/register-step2', [App\Http\Controllers\setupUserRegistration::class, 'createStep1'])->middleware('guest');
Route::post('/register-step2', [App\Http\Controllers\setupUserRegistration::class, 'create'])->name('register-step2');
Route::post('/register-final', [App\Http\Controllers\setupUserRegistration::class, 'registerUser'])->name('register-me');
Route::get('/session-check', [App\Http\Controllers\setupUserRegistration::class, 'sessionCheck']);


Route::resource('/dashboard/posts', App\Http\Controllers\PostController::class);

Route::get('/pass', function () {
	return Hash::make("123123123");
    //return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
