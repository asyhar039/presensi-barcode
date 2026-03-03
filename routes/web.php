<?php

use App\Http\Controllers\AttendanceViewController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// student login
Route::get('/login', [StudentAuthController::class, 'showLogin']);
Route::post('/login', [StudentAuthController::class, 'login']);
Route::post('/logout', [StudentAuthController::class, 'logout']);

// redirect bare /admin to login
Route::get('/admin', fn() => redirect('/admin/login'));

// admin login/dashboard
Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin/upload-students', [AdminController::class, 'uploadStudents']);
Route::get('/admin/qr-generator', [AdminController::class, 'showQrGenerator']);
Route::post('/admin/generate-qr', [AdminController::class, 'generateQrCode']);

// protected attendance view (for logged-in students or teachers)
Route::get('/', [AttendanceViewController::class, 'index']);
