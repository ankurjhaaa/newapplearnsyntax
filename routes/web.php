<?php

use App\Http\Controllers\CourseController;
use App\Models\Course;

Route::get('/', [CourseController::class, 'index'])->name('courses.index');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

Route::prefix('Api')->group(function () {
    Route::get('/allCourses', function () {
        $courses = Course::all();
        return response([
            'courses' => $courses
        ]);
    });
});