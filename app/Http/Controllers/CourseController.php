<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('welcome', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'nullable',
            'start_date' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return back()->with('success', 'Course Added Successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course Deleted Successfully!');
    }
}
