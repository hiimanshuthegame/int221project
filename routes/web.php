<?php

use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Productcontroller;
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

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});
Route::get('/login', function () {
    
    return view('login');
});
Route::get('/register', function () {
    
    return view('register');
});

Route::post("/login",[Usercontroller::class,'login']
); 
Route::post("/register",[Usercontroller::class,'register']
); 

Route::get("",[Productcontroller::class,'index']);
Route::get("detail/{id}",[ProductController::class,'detail']);
Route::post("add_to_cart",[Productcontroller::class,'addtocart']
); 
Route::get("cartlist",[ProductController::class,'cartList']); 
Route::get("removecart/{id}",[ProductController::class,'removeCart']);
