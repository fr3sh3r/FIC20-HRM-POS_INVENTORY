<?php

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//LOGIN ==> Login itu memakai POST
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//LOGOUT
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//roles
Route::apiResource('/roles', App\Http\Controllers\Api\RoleController::class)->middleware('auth:sanctum');

//Departments
Route::apiResource('/departments', App\Http\Controllers\Api\DepartmentController::class)->middleware('auth:sanctum');
//jika menulis auth:Sanctum , maka akan error

//Designations
Route::apiResource('/designations', App\Http\Controllers\Api\DesignationController::class)->middleware('auth:sanctum');

//shifts
Route::apiResource('/shifts', App\Http\Controllers\Api\ShiftController::class)->middleware('auth:sanctum');

//Basic Salary
Route::apiResource('/basic-salaries', App\Http\Controllers\Api\BasicSalaryController::class)->middleware('auth:sanctum');

//Role User
Route::apiResource('/role-users', App\Http\Controllers\Api\RoleUserController::class)->middleware('auth:sanctum');

//Holidays
Route::apiResource('/holidays', App\Http\Controllers\Api\HolidayController::class)->middleware('auth:sanctum');

//Permission
Route::apiResource('/permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

//Permission
Route::apiResource('/permission-roles', App\Http\Controllers\Api\PermissionRoleController::class)->middleware('auth:sanctum');

//Leave Type
Route::apiResource('/leave-types', App\Http\Controllers\Api\LeaveTypeController::class)->middleware('auth:sanctum');

//Leave
Route::apiResource('/leaves', App\Http\Controllers\Api\LeaveController::class)->middleware('auth:sanctum');

//Attendance
Route::apiResource('/attendances', App\Http\Controllers\Api\AttendanceController::class)->middleware('auth:sanctum');

//Payroll
Route::apiResource('/payrolls', App\Http\Controllers\Api\PayrollController::class)->middleware('auth:sanctum');

//User
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class)->middleware('auth:sanctum');
