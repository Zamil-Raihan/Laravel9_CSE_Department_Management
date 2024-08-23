<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;


Route::get('/', [CourseController::class, 'index_home'])->name('index');
Route::get('/teachers_s', [TeacherController::class, 'index_public'])->name('teacher.index_public');
Route::get('/courses_s', [CourseController::class, 'index_public'])->name('course.index_public');
Route::get('/notices_s', [NoticeController::class, 'index_public'])->name('notice.index_public');


Auth::routes();

//Teacher and Courser manage for both admin and teacher
Route::get('/teachers_edit_{teacher}', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
Route::get('/courses_edit_{course}', [CourseController::class, 'edit'])->name('course.edit');
Route::get('/courses_view_{course}', [CourseController::class, 'view'])->name('course.view');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('course.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('course.destroy');

// Default route (accessible to all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Student route (requires student role) 
Route::middleware(['auth', 'role:0'])->group(function () {
    // Feedback routes
    Route::get('/feedbacks_create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedbacks', [FeedbackController::class, 'store'])->name('feedback.store');
});

// Admin route (requires admin role)
Route::middleware(['auth', 'role:1'])->group(function () {
    //Teacher_Manage
    Route::get('/home_admin', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teachers_create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teacher.store');
    //Notice_Manage
    Route::get('/notices', [NoticeController::class, 'index'])->name('notice.index');
    Route::get('/notices_create', [NoticeController::class, 'create'])->name('notice.create');
    Route::post('/notices', [NoticeController::class, 'store'])->name('notice.store');
    Route::get('/notices_edit_{notice}', [NoticeController::class, 'edit'])->name('notice.edit');
    Route::put('/notices/{notice}', [NoticeController::class, 'update'])->name('notice.update');
    Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notice.destroy');
    //Course_Manage
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses_create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('course.store');
    // Feedback routes
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
});

// Teacher route (requires teacher role)
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/home_teacher', [HomeController::class, 'teacherHome'])->name('teacher.home');
    //News_Manage
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news_create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news_edit_{news}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});
