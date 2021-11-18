<?php

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

Auth::routes();

Route::middleware(["auth"])->group(function () {
  
    Route::get("/",              [App\Http\Controllers\HomeController::class, "index"]);
    Route::get("/home",          [App\Http\Controllers\HomeController::class, "index"])->name("home");
    Route::get("/tratamentos",   [App\Http\Controllers\HomeController::class, "treatments"])->name("treatments");
    Route::get("/meus-sorrisos", [App\Http\Controllers\HomeController::class, "mySmiles"])->name("patient.my.smiles");

});
