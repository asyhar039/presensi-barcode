<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;

Route::post('/create-session', [AttendanceController::class,'createSession']);
Route::post('/scan', [AttendanceController::class,'scan']);
