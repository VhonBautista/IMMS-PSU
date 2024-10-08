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
use App\Models\Matrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        // Auth User ID
        $userId = $request->user()->id;
        
        // Filter
        $searchFilter = $request->search;
        $typeFilter = $request->type;
        $startFilter = $request->start;
        $endFilter = $request->end;
        $startFormatted = date('Y-m-d 00:00:00', strtotime($startFilter));
        $endFormatted = date('Y-m-d 23:59:59', strtotime($endFilter));

        $departments = Department::orderBy('department_name', 'asc')->get();
        $courses = Course::orderBy('course_name', 'asc')->get();
        $campuses = Campus::orderBy('campus_name', 'asc')->get();
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
      
        $pendingMaterials = $pendingInstructionalMaterials->whereIn('status', ['evaluating', 'pending'])
            ->where('submitter_id', $userId)
            ->orderBy('title', 'asc')
            ->paginate(5);

        $resubmissionMaterials = $resubmissionInstructionalMaterials->where('status', 'resubmission')
            ->where('submitter_id', $userId)
            ->orderBy('title', 'asc')
            ->paginate(5);

        $approvedMaterials = $approvedInstructionalMaterials->where('status', 'approved')
            ->where('submitter_id', $userId)
            ->orderBy('title', 'asc')
            ->paginate(5);
            
        $statusCounts = InstructionalMaterial::select('status', InstructionalMaterial::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->get();

        $totalSubmittedByUser = InstructionalMaterial::where('submitter_id', auth()->id())->count();
        return view('user.submission-management', compact('pendingMaterials', 'resubmissionMaterials', 'approvedMaterials', 'departments', 'courses', 'campuses','statusCounts', 'totalSubmittedByUser'));
    }

    public function view($materialId)
    {
        $instructionalMaterial = InstructionalMaterial::findOrFail($materialId);

        $evaluations = $instructionalMaterial->evaluations()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.submission-view', compact('instructionalMaterial', 'evaluations'));
    }

    public function viewEvaluation(Request $request, $id)
    {
        $instructionalMaterial = InstructionalMaterial::findOrFail($id);

        $departments = Department::orderBy('department_name', 'asc')->get();
        $courses = Course::orderBy('course_name', 'asc')->get();
        $campuses = Campus::orderBy('campus_name', 'asc')->get();

        $evaluations = $instructionalMaterial->evaluations()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.submission-evaluation', compact('instructionalMaterial', 'evaluations', 'departments', 'courses', 'campuses'));
    }

    public function store(Request $request)
    {
        // Auth User
        $user = Auth::user();

        $request->validate([
            'title' => 'required',
            'proponents' => 'required|max:255',
            'pdf_path' => 'required|mimes:pdf,docx,jpg,png,jpeg|max:50000',
            'campus_id' => 'required|exists:campuses,id',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:course_book,textbook,modules,laboratory_manual,prototype,others',
        ]);

        $campusId = $request->input('campus_id');
        $campus = Campus::find($campusId);

        $matrix = Matrix::where('level', 'campus')
                ->where('campus_id', $campusId)
                ->where('stage', 1)
                ->first();

        if (!$matrix) {
            return redirect()->back()->with('error', 'Apologies, but currently, there is no available evaluation matrix for ' . $campus->campus_name );
        }

        $matrixId = $matrix->id;

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

        $area = 'evaluator.evaluation_management'; 
        $title = 'New Instructional Material Submitted'; 
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

    public function resubmit(Request $request)
    {
        // Auth User
        $user = Auth::user();

        $request->validate([
            'material_id' => 'required',
            'title' => 'required',
            'proponents' => 'required|max:255',
            'pdf_path' => 'required|mimes:pdf,docx,jpg,png,jpeg|max:50000',
            'campus_id' => 'required|exists:campuses,id',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:course_book,textbook,modules,laboratory_manual,prototype,others',
        ]);

        $instructionalMaterial = InstructionalMaterial::findOrFail($request->input('material_id'));
        $matrixId = $instructionalMaterial->evaluationStage->matrix_id;
        
        $oldPdfPath = $instructionalMaterial->pdf_path;
        $oldPdfPath = str_replace('storage/', 'public/', $oldPdfPath);
        
        // Delete the old PDF file
        if (Storage::exists($oldPdfPath)) {
            Storage::delete($oldPdfPath);
        } else {
            dd('did not exist: ' . $oldPdfPath);
        }

        // Store the new Material PDF to storage
        $originalFileName = $request->file('pdf_path')->getClientOriginalName();
        $uniqueFileName = time() . '_' . $originalFileName;
        $pdfPath = $request->file('pdf_path')->storeAs('pdfs', $uniqueFileName, 'public');
        $pdfPath = 'storage/' . $pdfPath;

        // Update instructional material
        $instructionalMaterial->update([
            'title' => $request->input('title'),
            'proponents' => $request->input('proponents'),
            'pdf_path' => $pdfPath,
            'campus_id' => $request->input('campus_id'),
            'department_id' => $request->input('department_id'),
            'course_id' => $request->input('course_id'),
            'type' => $request->input('type'),
            'status' => 'pending', 
        ]);

        $campus = Campus::findOrFail($request->input('campus_id'));
        $courses = Course::where('campus_id', $campus->id)->get();
        $departments = Department::where('campus_id', $campus->id)->get();

        $area = 'evaluator.evaluation_management'; 
        $title = 'Instructional Material Resubmitted'; 
        $action = 'submitted'; 
        $description = $user->firstname . ' ' . $user->lastname . ' resubmitted the Instructional Material titled "' . $request->input('title') . '".'; 
        
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

        return redirect()->route('submission_management', ['courses' => $courses, 'departments' => $departments,])->with('success', 'Instructional material has been resubmitted!');
    }

    public function getCourses($campusId)
    {
        $courses = Course::where('campus_id', $campusId)->orderBy('course_name', 'asc')->get();
        return response()->json(['courses' => $courses]);
    }

    public function getDepartments($campusId)
    {
        $departments = Department::where('campus_id', $campusId)->orderBy('department_name', 'asc')->get();
        return response()->json(['departments' => $departments]);
    }
}
