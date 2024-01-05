<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use App\Models\Department;
use App\Models\Course;
use App\Models\Campus;
use App\Models\User;
use App\Models\InstructionalMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $universityRoleFilter = $request->university_role;
        $departments = department::all();
        $courses = Course::all();
        $campuses = Campus::all();
        $user = User::all();
        $ims = InstructionalMaterial::query();
        $start = $request->input('start');
        $end = $request->input('end');

        if ($searchFilter) {
            $ims->where(function($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%")
                    ->orWhere('proponents', 'like', "%{$searchFilter}%")
                    ->orWhere('type', 'like', "%{$searchFilter}%");
            });
        }
        $submissions = InstructionalMaterial::whereBetween('created_at', [Carbon::parse($start), Carbon::parse($end)->endOfDay()])
        ->get();
        $ims = $ims->orderBy('title', 'asc')->paginate(10);

        return view('user.submission-management', compact('ims','departments','courses','campuses','user','submissions'));
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'proponents' => 'required|max:255',
        'pdf_path' => 'required|mimes:pdf|max:50000',
        'campus_id' => 'required|exists:campuses,id',
        'department_id' => 'required|exists:departments,id',
        'course_id' => 'required|exists:courses,id',
        'type' => 'required|in:course_book,textbook,modules,laboratory_manual,prototype,others',
        'status' => 'required|in:pending,evaluating,resubmission,approved',
    ]);

    $pdfPath = $request->file('pdf_path')->storeAs('instructional_materials', $request->file('pdf_path')->getClientOriginalName(), 'public');

    $user = Auth::user();

    InstructionalMaterial::create([
        'title' => $request->title,
        'pdf_path' => $pdfPath,
        'proponents' => $request->input('proponents'),
        'course_id' => $request->input('course_id'),
        'department_id' => $request->input('department_id'),
        'campus_id' => $request->input('campus_id'),
        'submitter_id' => $user->id,
        'type' => $request->input('type'),
        'status' => $request->input('status'),
    ]);

 
        $user = $request->user();
        $area = 'submission_management'; 
        $title = 'New Instructional Material Added'; 
        $action = 'added'; 
        $description = $user->firstname . ' ' . $user->lastname . ' added a new IM "' . $request->input('title') . '".'; 
        
   
        $users = User::where('role_id', 1)->get();

        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

       
    return redirect()->back()->with('success', 'Instructional Material added successfully!');
}
}
