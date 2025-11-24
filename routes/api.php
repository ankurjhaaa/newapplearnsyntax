<?php

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get("courses", function () {
    return Course::latest()->get();
});
Route::delete("courses/{id}", function ($id) {
    return Course::find($id)->delete();
});