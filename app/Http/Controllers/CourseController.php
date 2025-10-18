<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('createcouse' , ["user"=>$user]);
    }

    public function store(Request $request)
{
    $request->validate([
        'coach_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string|max:50',
        'picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle image upload
    $picturePath = null;
    if ($request->hasFile('picture')) {
        $files = $request->file('picture');
        if (count($files) > 0) {
            // Store the first image as the main course image
            $picturePath = $files[0]->store('course_pictures', 'public');
        }
    }

    // Create the course
    Course::create([
        'coach_id' => $request->coach_id,
        'title' => $request->title,
        'description' => $request->description,
        'duration' => $request->duration,
        'picture' => $picturePath,
    ]);

    return redirect()->back()->with('success', 'Course created successfully!');
}

public function show(Course $course)
{
    $user = auth()->user();

    return view('showcourse', compact('user' , 'course'));
}

// Show the form for editing the specified course
public function edit(Course $course)
{
    $user = auth()->user();

    return view('coach.sections.courses', compact('user' , 'course'));
}

// Update the specified course in storage
public function update(Request $request, Course $course)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string|max:50',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $course->title = $request->title;
    $course->description = $request->description;
    $course->duration = $request->duration;

    if ($request->hasFile('picture')) {
        $path = $request->file('picture')->store('course_pictures', 'public');
        $course->picture = $path;
    }

    $course->save();

    return redirect()->back()->with('success', 'Course updated successfully!');
}

// Remove the specified course from storage
public function destroy(Course $course)
{
    $course->delete();
    return redirect()->back()->with('success', 'Course deleted successfully!');
}

public function userCourses()
    {
        $user = auth()->user();
        $courses = Course::where('coach_id', auth()->user()->id)->get();
        return view('userCourses', compact('user' , 'courses'));
    }

}
