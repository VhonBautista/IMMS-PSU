<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Campus;

class CourseManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $campuses = Campus::all();
        $courses = Course::query();

        if ($searchFilter) {
            $courses->where(function($query) use ($searchFilter) {
                $query->where('course_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($campusFilter) {
            $courses->where('campus_id', $campusFilter);
        }

        $courses = $courses->orderBy('course_name', 'asc')->paginate(10);

        return view('admin.course-management', compact('courses', 'campuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        Course::create([
            'course_name' => $request->input('course_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        return redirect()->route('admin.course_management')->with('success', 'Course added successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $campuses = Campus::all();

        return view('admin.course-edit', compact('course', 'campuses'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'course_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        $course = Course::findOrFail($request->input('course_id'));

        $course->update([
            'course_name' => $request->input('course_name'),
            'campus_id' => $request->input('campus_id')
        ]);

        return redirect()->route('admin.course_management.edit', $request->input('course_id'))->with('success', 'Course updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
        ]);

        $course = Course::findOrFail($request->course_id);
        $course->delete();

        return redirect()->route('admin.course_management')->with(
            'success', 'Course deleted successfully.',
        );
    }
}