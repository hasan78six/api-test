<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(["middleware" => "auth:sanctum"], function (){
    Route::resource('user', UserController::class, ["except" => ["store"]]);
    Route::get('logout', [UserController::class, 'logout'])->name("logout");
    Route::put('user', [UserController::class, 'update'])->name("edit");
    Route::resource('products', ProductController::class);
    Route::resource('subcription', SubscriptionController::class);
    Route::get('unsubscribe', [SubscriptionController::class, 'unsubscribe']);
});

Route::resource('user', UserController::class, ["only" => ["store"]]);
Route::post('login', [UserController::class, 'login']);
Route::post('upd-status', [UserController::class, 'updateSubStatus']);
