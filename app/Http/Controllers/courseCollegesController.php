<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Course;
use App\Models\CourseCollege;
use Illuminate\Http\Request;


class courseCollegesController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $searchFilter = $request->search;
        $courseCol = CourseCollege::query();

        if ($searchFilter) {
            $courseCol->where(function($query) use ($searchFilter) {
                $query->where('college_id', 'like', "%{$searchFilter}%")
                    ->orWhere('course_id', 'like', "%{$searchFilter}%")
                    ->orWhere('created_at', 'like', "%{$searchFilter}%")
                    ->orWhere('updated_at', 'like', "%{$searchFilter}%");
            });
        }
        $coursecollege = $courseCol->orderBy('course_id', 'asc')->paginate(20);
        $colleges = College::all();
        $courses = Course::all();


    return view('admin.courseColleges', compact('coursecollege', 'colleges', 'courses'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'collegeId' => 'required',
            'courseId' => 'required',
            
        ]);

      
        CourseCollege::create([
            'college_id' => $request->input('collegeId'),
            'course_id' => $request->input('courseId'),
           
        ]);

        return redirect()->route('admin.courseColleges')->with('success', 'Course College Added successfully!');;
    }
    public function destroy($id)
    {
        $coursecollege = CourseCollege::findOrFail($id);
        $coursecollege->delete();

        return redirect()->route('admin.courseColleges')->with('success', 'Course College deleted successfully!');
    }

    
    public function edit($id)
    {
        $coursecollege = CourseCollege::findOrFail($id);
        $colleges = College::all();
        $courses = Course::all();
        
        return view('admin.course-colleges-edit', compact('coursecollege','colleges','courses'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'collegeId' => 'required|string',
            'courseId' => 'required|string',
            
        ]);

        $coursecollege = CourseCollege::findOrFail($id);
        

        $coursecollege->update([
            'college_id' => $request->input('collegeId'),
            'course_id' => $request->input('courseId'),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.courseColleges')->with('success','Course Collages Edited successfully!');
    }
}
