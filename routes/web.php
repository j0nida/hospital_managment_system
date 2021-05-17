<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Route::middleware("admin")->group(function () {
    Route::get("/admin",function(){
        return view('admin.dashboard',[
            'userCount' => User::all()->count()
            ]);
        })->name('dashboard');
    Route::get('/', function () {
            return view('admin.dashboard');
        });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get("/users", [App\Http\Controllers\UsersController::class, "index"])->name("users");
    Route::get("/user/{user}/profile", [App\Http\Controllers\UsersController::class, "profile"])->name("user.profile");
    Route::get("/admin/user/create", [App\Http\Controllers\UsersController::class, "create"])->name("admin.user.create");
    Route::post("/admin/user/store", [App\Http\Controllers\UsersController::class, "store"])->name("admin.user.store");
    Route::get("/admin/user/{user}/edit", [App\Http\Controllers\UsersController::class, "edit"])->name("admin.user.edit");
    Route::put("/admin/user/{user}/update", [App\Http\Controllers\UsersController::class, "update"])->name("admin.user.update");
    Route::delete("/admin/user/{user}/destroy", [App\Http\Controllers\UsersController::class, "destroy"])->name("admin.user.destroy");
    Route::post("/date", [App\Http\Controllers\UsersController::class, "setDate"])->name("setDate");
   
    Route::get("/admin/shift/create", [App\Http\Controllers\ScheduleController::class, "create"])->name("shift.create");
    Route::post("/admin/shift/employee/store", [App\Http\Controllers\ScheduleController::class, "store"])->name("shift.emp.store");

});