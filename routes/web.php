<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SessionController;
use App\Models\Category;
use App\Models\Restaurant;
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

Route::get('/', [RestaurantController::class,"index"]);
Route::get('/rating/{num:num}', function ($num){
    return view('welcome',[
        'restaurants' => Restaurant::all()->where('overall_like', '>', $num )->sortByDesc('overall_like'),
        'categories' => Category::all()
    ]);
});
Route::get('/restaurants/{restaurant:slug}', function (Restaurant $restaurant){
    return view('/restaurant',[
        'restaurant' => $restaurant,
        'categories' => Category::all()
    ]);
});
Route::post('/register', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::get('/index', function (){
    $restaurant = Restaurant::all()->where('user_id', auth()->id());
    return view('index', [
       'restaurants' => $restaurant->sortByDesc('overall_like'),
       'categories' => Category::all()
    ]);
});

Route::post('/rating/{restaurant:slug}', [RestaurantController::class, 'rating'])->middleware('auth');
Route::post('/restaurants/createReply/{rating:id}', [RestaurantController::class, 'createReply']);
Route::post('/createRestaurant', [RestaurantController::class, 'createRestaurant']);


Route::get('/admin/section/restaurants', [AdminController::class, 'index'])->middleware('admin');
Route::get('/admin/section/users', [AdminController::class, 'users'])->middleware('admin');
Route::get('/delete/user/{user:email}', [AdminController::class, 'deleteUser'])->middleware('admin');
Route::get('/delete/restaurant/{restaurant:slug}', [AdminController::class, 'deleteRestaurant'])->middleware('admin');
Route::get('/delete/comment/{comment:id}', [AdminController::class, 'deleteComment'])->middleware('admin');
Route::get('/delete/reply/{reply:id}', [AdminController::class, 'deleteReply'])->middleware('admin');
