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
    return view('auth.login');
})->middleware("redirectDashboard");



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

        //table
        Route::get("/admin/table", "TableController@index")->name(
            "table"
        );
        Route::post("/admin/table/store", "TableController@store")->name(
            "table.store"
        );
        Route::get("/admin/table/{id}", "TableController@find")->name(
            "table.find"
        );
        Route::post("/admin/table/update/{id}", "TableController@update")->name(
            "table.update"
        );
        Route::delete("/admin/table/{id}", "TableController@destroy")->name(
            "table.destroy"
        );

        //menu
        Route::get("/admin/menu", "MenuController@index")->name(
            "menu"
        );
        Route::post("/admin/menu/store", "MenuController@store")->name(
            "menu.store"
        );
        Route::get("/admin/menu/{id}", "MenuController@find")->name(
            "menu.find"
        );
        Route::post("/admin/menu/update/{id}", "MenuController@update")->name(
            "menu.update"
        );
        Route::delete("/admin/menu/{id}", "MenuController@destroy")->name(
            "menu.destroy"
        );

        //order
        Route::get("/admin/order", "OrderController@index")->name(
            "order"
        );

        Route::post("/admin/order/store", "OrderController@store")->name(
            "order.store"
        );

        Route::get("/admin/order/{id}", "OrderController@find")->name(
            "order.find"
        );

        Route::delete("/admin/order/{id}", "OrderController@destroy")->name(
            "order.destroy"
        );

        Route::get("/admin/order/print/{id}", "OrderController@printOrder")->name(
            "order.print"
        );


        //menu
        Route::get("/admin/reservation", "ReservationController@index")->name(
            "reservation"
        );
        Route::post("/admin/reservation/store", "ReservationController@store")->name(
            "reservation.store"
        );
        Route::get("/admin/reservation/{id}", "ReservationController@find")->name(
            "reservation.find"
        );
        Route::post("/admin/reservation/update/{id}", "ReservationController@update")->name(
            "reservation.update"
        );
        Route::delete("/admin/reservation/{id}", "ReservationController@destroy")->name(
            "reservation.destroy"
        );

        Route::get("/admin/reservation/print/{id}", "ReservationController@printReservation")->name(
            "reservation.print"
        );
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
