<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});



Route::resource('items', ItemController::class)->middleware('auth');
Route::resource('categories', CategoryController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
