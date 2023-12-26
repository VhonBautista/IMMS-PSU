<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Campus;


class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $searchFilter = $request->search;
        $courseQuery = Course::query();

        // Join with the campuses table to fetch campus_name
        $courseQuery->join('campuses', 'courses.campus_id', '=', 'campuses.id')
                    ->select('courses.*', 'campuses.campus_name');

        if ($searchFilter) {
            $courseQuery->where(function($query) use ($searchFilter) {
                $query->where('course_name', 'like', "%{$searchFilter}%")
                    ->orWhere('campuses.campus_name', 'like', "%{$searchFilter}%") 
                    ->orWhere('courses.created_at', 'like', "%{$searchFilter}%")
                    ->orWhere('courses.updated_at', 'like', "%{$searchFilter}%");
            });
        }

        $courses = $courseQuery->orderBy('courses.course_name', 'asc')
                              ->paginate(10);

        // line to fetch campus
        $campuses = Campus::pluck('campus_name', 'id'); 


        return view('admin.course-management', compact('courses', 'campuses'));
    }

    
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $campuses = Campus::pluck('campus_name', 'id');

        return view('admin.course-edit', compact('course', 'campuses'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id', // here is the selected campus which is exists in the campuses table
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'course_name' => $request->input('course_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        return redirect()->route('admin.course_management')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.course_management')->with('success', 'Course deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'new_course_name' => 'required|string|max:255',
            'new_campus_id' => 'required|exists:campuses,id',
        ]);

        Course::create([
            'course_name' => $request->input('new_course_name'),
            'campus_id' => $request->input('new_campus_id'),
        ]);

        return redirect()->route('admin.course_management')->with('success', 'Course added successfully.');
    }

}
