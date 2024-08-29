<?php

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//LOGIN ==> Login itu memakai POST
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//LOGOUT
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//semua diberi prefix api-xxx, supaya tidak konflik dengan web.php
//roles
Route::apiResource('/api-roles', App\Http\Controllers\Api\RoleController::class)->middleware('auth:sanctum');

//Departments
Route::apiResource('/api-departments', App\Http\Controllers\Api\DepartmentController::class)->middleware('auth:sanctum');
//jika menulis auth:Sanctum , maka akan error

//Designations
Route::apiResource('/api-designations', App\Http\Controllers\Api\DesignationController::class)->middleware('auth:sanctum');

//shifts
Route::apiResource('/api-shifts', App\Http\Controllers\Api\ShiftController::class)->middleware('auth:sanctum');

//Basic Salary
Route::apiResource('/api-basic-salaries', App\Http\Controllers\Api\BasicSalaryController::class)->middleware('auth:sanctum');

//Role User
Route::apiResource('/api-role-users', App\Http\Controllers\Api\RoleUserController::class)->middleware('auth:sanctum');

//Holidays
Route::apiResource('/api-holidays', App\Http\Controllers\Api\HolidayController::class)->middleware('auth:sanctum');

//Permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

//Permission
Route::apiResource('/api-permission-roles', App\Http\Controllers\Api\PermissionRoleController::class)->middleware('auth:sanctum');

//Leave Type
Route::apiResource('/api-leave-types', App\Http\Controllers\Api\LeaveTypeController::class)->middleware('auth:sanctum');

//Leave
Route::apiResource('/api-leaves', App\Http\Controllers\Api\LeaveController::class)->middleware('auth:sanctum');

//Attendance
Route::apiResource('/api-attendances', App\Http\Controllers\Api\AttendanceController::class)->middleware('auth:sanctum');

//Payroll
Route::apiResource('/api-payrolls', App\Http\Controllers\Api\PayrollController::class)->middleware('auth:sanctum');

//User
Route::apiResource('/api-users', App\Http\Controllers\Api\UserController::class)->middleware('auth:sanctum');
