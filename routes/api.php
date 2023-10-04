<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/login', [AuthController::class, 'loginUser']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/employee', [EmployeeController::class, 'show'])->name('employee.show');

    Route::post('/attendance', [AttendanceController::class, 'mark'])->name('attendance.mark');

    Route::post('/leave', [AttendanceController::class, 'leave'])->name('attendance.leave');

    Route::post('/delay', [AttendanceController::class, 'delay'])->name('attendance.delay');




 

});
