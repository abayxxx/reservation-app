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


Route::get('/', function () {
    return view('welcome');
});



Route::namespace("Admin")
    ->name("admin.")
    ->middleware(["auth"])
    ->group(function () {

        Route::get("/admin/dashboard", "DashboardController@index")->name(
            "dashboard"
        );

        Route::get("/admin/dashboard/data", "DashboardController@filterMonth")->name(
            "dashboard.data"
        );

        //KRITERIA
        Route::get("/admin/kriteria", "KriteriaController@index")->name(
            "kriteria"
        );
        Route::post("/admin/kriteria/store", "KriteriaController@store")->name(
            "kriteria.store"
        );
        Route::get("/admin/kriteria/{id}", "KriteriaController@find")->name(
            "kriteria.find"
        );
        Route::post("/admin/kriteria/update/{id}", "KriteriaController@update")->name(
            "kriteria.update"
        );
        Route::delete("/admin/kriteria/{id}", "KriteriaController@destroy")->name(
            "kriteria.destroy"
        );

        //PERTANYAAN
        Route::get("/admin/pertanyaan", "PertanyaanController@index")->name(
            "pertanyaan"
        );
        Route::post("/admin/pertanyaan/store", "PertanyaanController@store")->name(
            "pertanyaan.store"
        );
        Route::get("/admin/pertanyaan/{id}", "PertanyaanController@find")->name(
            "pertanyaan.find"
        );
        Route::post("/admin/pertanyaan/update/{id}", "PertanyaanController@update")->name(
            "pertanyaan.update"
        );
        Route::delete("/admin/pertanyaan/{id}", "PertanyaanController@destroy")->name(
            "pertanyaan.destroy"
        );

        //RESPONDEN
        Route::get("/admin/responden", "RespondenController@index")->name(
            "responden"
        );

        Route::delete("/admin/responden/{id}", "RespondenController@destroy")->name(
            "responden.destroy"
        );

        Route::get("/admin/responden/jawaban", "RespondenController@jawaban")->name(
            "responden.jawaban"
        );

        //IPA
        Route::get("/admin/ipa/tingkat-kesesuaian", "TingkatKesesuaianController@index")->name(
            "ipa.tingkat-kesesuaian"
        );

        Route::get("/admin/ipa/rata-rata", "RataRataController@index")->name(
            "ipa.rata-rata"
        );
        Route::get("/admin/ipa/total-rata-rata", "RataRataController@total")->name(
            "ipa.rata-rata.total"
        );

        Route::get("/admin/ipa/keseluruhan-rata-rata", "KeseluruhanRataRataController@index")->name(
            "ipa.keseluruhan-rata-rata"
        );

        Route::get("/admin/ipa/pemetaan-atribut", "PemetaanAtributController@index")->name(
            "ipa.pemetaan-atribut"
        );

        Route::get("/admin/ipa/chart", "ChartController@index")->name(
            "ipa.chart"
        );
        Route::get('/admin/ipa/chart/data', 'ChartController@filterMonth')->name('ipa.chart.data');
    });


Route::name('guest.')->prefix("responden")->namespace("Responden")->group(function () {
    Route::get("/pertanyaan", "PertanyaanController@index")->name("pertanyaan");
    Route::get('/pertanyaan/{id}/{direction}', 'PertanyaanController@showQuestion')->name('ambil.pertanyaan');
    Route::post('/pertanyaan/submit', 'PertanyaanController@submitQuestion')->name('submit.pertanyaan');
});


Route::group(
    [
        "middleware" => ["guest"],
        "namespace" => "Auth",
        "prefix" => "auth",
    ],
    function () {


        // #register
        Route::get("register", "RegisterController@create")->name("register");
        Route::post("register", "RegisterController@store")
            ->middleware("throttle:register")
            ->name("register.store");

        #login
        Route::get("login", "LoginController@index")->middleware("redirectDashboard")->name("login");
        Route::post("login", "LoginController@login")
            ->name("login.store");

        #forgot password
        Route::get("forgot-password", "ForgotPasswordController@index")->name(
            "forgot-password"
        );

        Route::post("forgot-password", "ForgotPasswordController@store")
            ->name("forgot-password.store")
            ->middleware("throttle:forgot-password");

        # with no middleware
        //    Route::post('forgot-password', 'ForgotPasswordController@store')->name('forgot-password.store');

        // Route::get("/reset-password/{token}", function ($token) {
        //     return view("auth.reset-password", ["token" => $token]);
        // })->name("password.reset");

        // Route::post(
        //     "/reset-password",
        //     "ForgotPasswordController@resetPassword"
        // )->name("password.update");
    }

);
Route::prefix("auth")
    ->middleware(["auth"])
    ->namespace("Auth")
    ->group(function () {
        Route::get("logout", "LoginController@logout")->name("logout");
        Route::get("change-password", "ChangePasswordController@index")->name("change-password");
        Route::post("change-password/store", "ChangePasswordController@store")->name("change-password.store");
    });
