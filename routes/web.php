<?php

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
Route::get('/error/http', function () {
    return view('layouts.error.http');
});
Route::group(['middleware' => ['HTTPS']], function(){
    Route::middleware(['throttle:10,1'])->group(function () {
        Route::get('/', function () {
            return view('app');
        });
    });
});