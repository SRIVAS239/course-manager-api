<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->post('/courses', [CourseController::class, 'store']);
// Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::middleware('auth:api')->get('/courses/{id}/chapters', [CourseController::class, 'getChapters']);

// Route::middleware('auth:api')->post('/chapters/bulk', [ChapterController::class, 'storeBulk']);


Route::get('/courses', [CourseController::class, 'index']);

Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');

// Route::get('/course/{courseid}',[CourseController::class,'viewCourse']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
