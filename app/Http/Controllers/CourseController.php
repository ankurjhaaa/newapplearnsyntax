<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

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

        // Initialize ImageKit
        $imageKit = new ImageKit(
            config('imagekit.public_key'),
            config('imagekit.private_key'),
            config('imagekit.url_endpoint')
        );

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileData = base64_encode(file_get_contents($file));

            // Upload to ImageKit
            $upload = $imageKit->upload([
                "file" => $fileData,
                "fileName" => time() . '.' . $file->getClientOriginalExtension(),
                "folder" => "/courses"
            ]);

            // Error check
            if ($upload->error) {
                return back()->with('error', 'Image Upload Failed: ' . $upload->error->message);
            }

            // ✔ Correct Image URL
            $data['image'] = $upload->result->url;
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
