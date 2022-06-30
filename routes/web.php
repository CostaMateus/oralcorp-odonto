<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalEasyController;
use App\Http\Controllers\Auth\RegisterController;
use Composer\Command\HomeCommand;

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

Auth::routes(["register" => false]);

Route::post("/login", [PersonalEasyController::class, "login"]);

Route::get( "/newpass",        [PersonalEasyController::class, "newPassword"])  ->name("new.password");
Route::post("/savepass",       [PersonalEasyController::class, "savePassword"]) ->name("save.password");
Route::post("/password/reset", [PersonalEasyController::class, "resetPassword"])->name("reset.password");

Route::get("/cadastro-membro", [RegisterController::class, "showMemberRegistrationForm"])->name("member.register");

Route::middleware(["auth"])->group(function () {

    Route::get("/",                 [HomeController::class, "index"]);
    Route::get("/home",             [HomeController::class, "index"])         ->name("home");

    Route::get("/tratamentos",      [HomeController::class, "treatments"])    ->name("patient.treatments");
    Route::get("/meus-sorrisos",    [HomeController::class, "mySmiles"])      ->name("patient.my_smiles");
    Route::get("/financeiro",       [HomeController::class, "financial"])     ->name("patient.financial");
    Route::get("/indique",          [HomeController::class, "indicate"])      ->name("patient.indicate");

    Route::get( "/agenda",          [HomeController::class, "schedule"])      ->name("patient.schedule");
    Route::post("/agenda/marcar",   [HomeController::class, "createSchedule"])->name("patient.create.schedule");
    Route::post("/agenda/cancelar", [HomeController::class, "cancelSchedule"])->name("patient.cancel.schedule");

    Route::get( "/contatos",        [HomeController::class, "contacts"])      ->name("patient.contacts");
    Route::post("/contatos",        [HomeController::class, "postContacts"])  ->name("patient.post.contacts");

    Route::get( "/checkin",         [HomeController::class, "checkin"])       ->name("patient.checkin");
    Route::post("/checkin",         [HomeController::class, "postCheckin"])   ->name("patient.post.checkin");

    Route::middleware(["role:admin"])->group(function () {

        // Route::get("/usuarios", [UserController::class, "checkin"])   ->name("patient.checkin");

    });

});
