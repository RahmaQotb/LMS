<?php

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\BaseExamController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\IntelliController;
use App\Http\Controllers\Api\MathController;

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


Route::post("register", [AuthController::class, "register"])->name('register');
Route::post("login", [AuthController::class, "login"])->name('login');

Route::middleware("auth:sanctum")->group(function() {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post("logout", [AuthController::class, "logout"])->name('logout');
});




// // Routes for Subjects (Read-only)
// Route::get('/subjects', [ExamController::class, 'getSubjects']); // عرض جميع المواد
// Route::get('/subjects/{id}', [ExamController::class, 'getSubject']); // عرض مادة معينة
