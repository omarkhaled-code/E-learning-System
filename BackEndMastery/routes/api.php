<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TestimonialController;
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


Route::middleware('auth:sanctum')->group( function () {
    //auth
    Route::get('get-access/{id}', [AuthController::class, 'get_access']);
    Route::post('delete-user/{id}', [AuthController::class, 'delete']);
    Route::get("show", [AuthController::class, 'show']);
    Route::get("user", [AuthController::class, 'user']);
    Route::post("update-user", [AuthController::class, 'update']);
    Route::post("logout", [AuthController::class, 'logout']); 

    //category
    Route::post('create-cat', [CategoryController::class, 'create']);
    Route::post('edit-cat', [CategoryController::class, 'edit']);
    Route::post('update-cat', [CategoryController::class, 'update']);
    Route::post('delete-cat', [CategoryController::class, 'delete']);

    //course
    Route::get('my-courses/{id}', [CoursesController::class, 'my_courses']);
    
    //blog
    Route::get('my-blogs/{id}', [BlogController::class, 'my_blogs']);
    Route::get('edit-blog/{id}', [BlogController::class, 'edit']);
    Route::post('update-blog', [BlogController::class, 'update']);
    Route::post('delete-blog/{id}', [BlogController::class, 'delete']);
    Route::post('create-blog', [BlogController::class, 'create']);
    

    //testimonial
    Route::get('testimonial/{id}', [TestimonialController::class, 'check_testimonial']);
    Route::post('create-testimonial', [TestimonialController::class, 'create']);
    
});

// auth
Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
Route::post('subscription', [AuthController::class, 'subscription']);
Route::get('latest-teacher', [AuthController::class, 'latestTeacher']);
Route::get("all-teacher", [AuthController::class, 'allTeacher']); 

//courses routes
Route::get('all-courses', [CoursesController::class, 'index']);
Route::get('latest-courses', [CoursesController::class, 'latestCourses']);
Route::post('create-course', [CoursesController::class, 'create']);
Route::post('edit-course', [CoursesController::class, 'edit']);
Route::post('update-course', [CoursesController::class, 'update']);
Route::post('delete-course', [CoursesController::class, 'delete']);
Route::get('video-stream/{id}', [CoursesController::class, 'streamVideo']);
Route::get('course/{id}/{user_id}', [CoursesController::class, 'show']);


//category
Route::post('show-cat', [CategoryController::class, 'show']);
Route::get('all-cat', [CategoryController::class, 'index']);
Route::get('lastCat', [CategoryController::class, 'lastCategory']);
Route::get('show', [CategoryController::class, 'show']);
Route::get('get-links', [CategoryController::class, 'getLinks']);

// blogs 
Route::get('all-blog', [BlogController::class, 'index']);
Route::get('last-blog', [BlogController::class, 'lastBlogs']);
Route::get('blog/{id}', [BlogController::class, 'show']);

// testimonial
Route::get('all-testimonial', [TestimonialController::class, 'index']);