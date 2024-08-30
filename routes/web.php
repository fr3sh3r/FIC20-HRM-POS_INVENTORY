<?php

use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\BasicSalaryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Web\DesignationController;
use App\Http\Controllers\Web\HolidayController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {

    route::get('home', function () {
        return view('dashboard');
    })->name('home');

    Route::resource('users', UserController::class);  //nama tidak bisa users karena konflik dengan api   sama users
    //agar tidak terjadi error Undefined type 'UserController'.
    //maka harus import dulu use App\Http\Controllers\UserController;

    Route::resource('attendances', AttendanceController::class);
    Route::resource('basic-salaries', BasicSalaryController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('holidays', HolidayController::class);
});
