<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Campus;
use Illuminate\Support\Facades\Notification;
class CourseManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $campuses = Campus::orderBy('campus_name', 'asc')->get();
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

        $user = $request->user();
        $area = 'admin.course_management'; 
        $title = 'New course Added'; 
        $action = 'added'; 
        $description = $user->firstname . ' ' . $user->lastname . ' added a new course "' . $request->input('course_name') . '".';
        
        
        $users = User::where('role_id', 1)->get();

        
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        return redirect()->route('admin.course_management')->with('success', 'Course added successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $campuses = Campus::orderBy('campus_name', 'asc')->get();

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

        $user = $request->user();
        $area = 'admin.course_management'; 
        $title = ' course Information Updated '; 
        $action = 'updated'; 
        $description = $user->firstname . ' ' . $user->lastname . ' updated the course infromation of "' . $request->input('course_name') . '".';
        
        
        $users = User::where('role_id', 1)->get();

        
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        return redirect()->route('admin.course_management.edit', $request->input('course_id'))->with('success', 'Course updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
        ]);

        $course = Course::findOrFail($request->course_id);
        $course->delete();

        $user = $request->user();
        $area = 'admin.course_management'; 
        $title = ' course deleted'; 
        $action = 'deleted'; 
        $description = $user->firstname . ' ' . $user->lastname . ' deleted the course "' . $course->course_name . '".';
        
        
        $users = User::where('role_id', 1)->get();

        
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        return redirect()->route('admin.course_management')->with(
            'success', 'Course deleted successfully.',
        );
    }
}