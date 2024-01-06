<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Department;
use App\Models\Course;
use App\Models\Campus;
use App\Models\EvaluationStage;
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
        $typeFilter = $request->type;
        $startFilter = $request->start;
        $endFilter = $request->end;
        $startFormatted = date('Y-m-d 00:00:00', strtotime($startFilter));
        $endFormatted = date('Y-m-d 23:59:59', strtotime($endFilter));

        $departments = department::all();
        $courses = Course::all();
        $campuses = Campus::all();
        $user = User::all();
        $pendingInstructionalMaterials = InstructionalMaterial::query();
        $resubmissionInstructionalMaterials = InstructionalMaterial::query();
        $approvedInstructionalMaterials = InstructionalMaterial::query();
        
        if ($searchFilter) {
            $pendingInstructionalMaterials->where(function($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%");
            });
            $resubmissionInstructionalMaterials->where(function($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%");
            });
            $approvedInstructionalMaterials->where(function($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%");
            });
        }

        if ($typeFilter) {
            $pendingInstructionalMaterials->where('type', $typeFilter);
            $resubmissionInstructionalMaterials->where('type', $typeFilter);
            $approvedInstructionalMaterials->where('type', $typeFilter);
        }

        if ($startFilter && $endFilter) {
            $pendingInstructionalMaterials->whereBetween('created_at', [$startFormatted, $endFormatted]);
            $resubmissionInstructionalMaterials->whereBetween('created_at', [$startFormatted, $endFormatted]);
            $approvedInstructionalMaterials->whereBetween('created_at', [$startFormatted, $endFormatted]);
        }
      
        $pendingMaterials = $pendingInstructionalMaterials->where('status', 'pending')->orderBy('title', 'asc')->paginate(10);
        $resubmissionMaterials = $resubmissionInstructionalMaterials->where('status', 'resubmission')->orderBy('title', 'asc')->paginate(10);
        $approvedMaterials = $approvedInstructionalMaterials->where('status', 'approved')->orderBy('title', 'asc')->paginate(10);

        return view('user.submission-management', compact('pendingMaterials', 'resubmissionMaterials', 'approvedMaterials', 'departments', 'courses', 'campuses', 'user'));
    }

    public function view($materialId)
    {
        $instructionalMaterial = InstructionalMaterial::findOrFail($materialId);

        // todo: get * evaluation history and pass to compact

        return view('material-view', compact('instructionalMaterial'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // todo: matrix id will come from matrix where stage is == first
        $matrixId = 1;

        $request->validate([
            'title' => 'required',
            'proponents' => 'required|max:255',
            'pdf_path' => 'required|mimes:pdf|max:50000',
            'campus_id' => 'required|exists:campuses,id',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:course_book,textbook,modules,laboratory_manual,prototype,others',
        ]);

        // Store Material PDF to storage
        $originalFileName = $request->file('pdf_path')->getClientOriginalName();
        $uniqueFileName = time() . '_' . $originalFileName;
        $pdfPath = $request->file('pdf_path')->storeAs('pdfs', $uniqueFileName, 'public');
        $pdfPath = 'storage/' . $pdfPath;

        $instructionalMaterial = InstructionalMaterial::create([
            'title' => $request->title,
            'pdf_path' => $pdfPath,
            'proponents' => $request->input('proponents'),
            'course_id' => $request->input('course_id'),
            'department_id' => $request->input('department_id'),
            'campus_id' => $request->input('campus_id'),
            'submitter_id' => $user->id,
            'type' => $request->input('type'),
        ]);

        EvaluationStage::create([
            'matrix_id' => $matrixId,
            'material_id' => $instructionalMaterial->id,
        ]);

        $area = 'evaluation_management'; 
        $title = 'New Instructional Material Added'; 
        $action = 'submitted'; 
        $description = $user->firstname . ' ' . $user->lastname . ' submitted a new Instructional Material titled "' . $request->input('title') . '".'; 
        
        $users = User::where('role_id', 3)
            ->whereHas('evaluatorMatrix', function ($query) use ($matrixId) {
                $query->where('matrix_id', $matrixId);
            })
            ->get();

        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        if ($users) {
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        return redirect()->back()->with('success', 'Instructional material submitted successfully!');
    }
    public function getCourses($campusId)
    {
        $courses = Course::where('campus_id', $campusId)->get();
        return response()->json(['courses' => $courses]);
    }

    public function getDepartments($campusId)
    {
        $departments = Department::where('campus_id', $campusId)->get();
        return response()->json(['departments' => $departments]);
    }

}
