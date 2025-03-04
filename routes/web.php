<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Models\Exam;
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

Route::get('students/requests', [StudentController::class, 'studentReq'])->name('students.request');

require __DIR__."/dashboard.php";
