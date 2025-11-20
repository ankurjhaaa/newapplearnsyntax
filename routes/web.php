<?php

use App\Http\Controllers\CourseController;
use App\Models\Course;

Route::get('/', [CourseController::class, 'index'])->name('courses.index');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

Route::prefix("api")->group(function () {
    Route::get("courses", function () {
        return Course::latest()->get();
    });
});
