<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\EnrollmentController;
use App\Http\Middleware\CheckEmailDomain;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'throttle:5,1', CheckEmailDomain::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //student
    Route::apiResource('students', StudentController::class);
    //teacher
    Route::apiResource('teachers', TeacherController::class);
    //course
    Route::apiResource('courses', CourseController::class);
    //enrollment
    Route::post('/enroll', [EnrollmentController::class, 'enroll']);
    Route::post('/unenroll', [EnrollmentController::class, 'unenroll']);
});
