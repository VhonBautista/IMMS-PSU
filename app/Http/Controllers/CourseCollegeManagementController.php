<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\College;
use App\Models\Course;
use App\Models\CourseCollege;
use Illuminate\Http\Request;


class CourseCollegeManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $courses = Course::all();
        $campuses = Campus::all();
        $colleges = College::query();

        if ($searchFilter) {
            $colleges->where(function($query) use ($searchFilter) {
                $query->where('college_name', 'like', "%{$searchFilter}%");
            });
        }
        
        if ($campusFilter) {
            $colleges->where('campus_id', $campusFilter);
        }

        $colleges = $colleges->orderBy('college_name', 'asc')->paginate(5);

        return view('admin.course-college-management', compact('courses', 'campuses', 'colleges'));
    }

    public function getCoursesForCollege($collegeId)
    {
        $college = College::findOrFail($collegeId);
        $collegeCampusId = $college->campus_id;

        $courses = Course::whereDoesntHave('colleges', function ($query) use ($collegeId) {
            $query->where('college_id', $collegeId);
        })
        ->where('campus_id', $collegeCampusId)
        ->orderBy('course_name', 'asc')
        ->get();

        return view('admin.course-college-modal', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'college_id' => 'required|numeric',
            'course_ids' => 'required|array',
            'course_ids.*' => 'numeric|exists:courses,id',
        ]);

        $collegeId = $request->college_id;
        $courseIds = $request->course_ids;

        $college = College::findOrFail($collegeId);
        $collegeName = $college->college_name;

        foreach ($courseIds as $courseId) {
            CourseCollege::create([
                'college_id' => $collegeId,
                'course_id' => $courseId,
            ]);
        }

        return redirect()->route('admin.course_college_management')->with('success', 'Course(s) have been successfully added to ' . $collegeName . '!');;
    }

    public function remove($collegeId, $courseId)
    {
        $coursecollege = CourseCollege::where('college_id', $collegeId)
                                   ->where('course_id', $courseId)
                                   ->firstOrFail();

        $coursecollege->delete();

        return redirect()->route('admin.course_college_management')->with('success', 'Course removed successfully!');
    }
}
