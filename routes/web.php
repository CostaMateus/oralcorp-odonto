<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get("/cadastro-membro", [RegisterController::class, "showMemberRegistrationForm"])->name("member.register");

Route::middleware(["auth"])->group(function () {

    Route::get("/",              [HomeController::class, "index"]);
    Route::get("/home",          [HomeController::class, "index"])     ->name("home");

    Route::get("/tratamentos",   [HomeController::class, "treatments"])->name("patient.treatments");
    Route::get("/contatos",      [HomeController::class, "contacts"])  ->name("patient.contacts");
    Route::get("/agenda",        [HomeController::class, "schedule"])  ->name("patient.schedule");
    Route::get("/meus-sorrisos", [HomeController::class, "mySmiles"])  ->name("patient.my_smiles");
    Route::get("/financeiro",    [HomeController::class, "financial"]) ->name("patient.financial");
    Route::get("/indique",       [HomeController::class, "indicate"])  ->name("patient.indicate");
    Route::get("/checkin",       [HomeController::class, "checkin"])   ->name("patient.checkin");

    Route::middleware(["role:member"])->group(function () {});

});
