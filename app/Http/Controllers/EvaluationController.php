<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationStage;
use App\Models\EvaluatorMatrix;
use App\Models\InstructionalMaterial;
use App\Models\Log;
use App\Models\Matrix;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        // Auth User
        $user = $request->user();
        
        // Filter
        $searchFilter = $request->search;
        $typeFilter = $request->type;

        $forEvaluationMaterials = EvaluationStage::query();

        if ($searchFilter) {
            $forEvaluationMaterials->whereHas('instructionalMaterial', function ($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%");
            });
        }

        if ($typeFilter) {
            $forEvaluationMaterials->whereHas('instructionalMaterial', function ($query) use ($typeFilter) {
                $query->where('type', $typeFilter);
            });
        }
        
        $matrixId = 0;
        if ($user->evaluatorMatrix) {
            $matrixId = $user->evaluatorMatrix->matrix_id;

            if ($user->evaluatorMatrix->matrix->level == 'campus'){
                $campusId = $user->campus_id;

                $forEvaluationMaterials->whereHas('instructionalMaterial', function ($query) use ($campusId) {
                    $query->where('campus_id', $campusId);
                });
            }
        }

        $forEvaluationMaterials = $forEvaluationMaterials->where('matrix_id', $matrixId)
            ->join('instructional_materials', 'evaluation_stages.material_id', '=', 'instructional_materials.id')
            ->whereHas('instructionalMaterial', function ($query) {
                $query->whereIn('status', ['pending', 'evaluating']);
            })
            ->whereDoesntHave('instructionalMaterial.evaluations', function ($query) use ($user, $matrixId) {
                $query->where('evaluator_id', $user->id)
                    ->where('matrix_id', $matrixId)
                    ->where('status', 'passed');
            })
            ->with(['instructionalMaterial'])
            ->orderBy('instructional_materials.updated_at', 'asc')
            ->select('evaluation_stages.*')
            ->paginate(5);
            
        return view('evaluator.evaluation-management', compact('forEvaluationMaterials', 'user'));
    }

    public function evaluate(Request $request, $materialId)
    {
        // Auth User
        $user = $request->user();

        $matrix = $user->evaluatorMatrix->matrix;
        $instructionalMaterial = InstructionalMaterial::findOrFail($materialId);

        $instructionalMaterial->update([
            'status' => 'evaluating',
        ]); 

        return view('evaluator.evaluation-evaluate', compact('instructionalMaterial', 'matrix'));
    }
    
    public function store(Request $request)
    {
        // Auth User
        $user = $request->user();
        $universityRole = $request->user()->univ_role_id;
        $role = $request->user()->role_id;

        $request->validate([
            'matrix_id' => 'required',
            'material_id' => 'required',
            'passed_criteria' => 'required|string',
            'comment' => 'required|string',
            'status' => 'required|string',
        ]);

        $status = $request->input('status');
        $matrixId = $request->input('matrix_id');
        $instructionalMaterialId = $request->input('material_id');

        $instructionalMaterial = InstructionalMaterial::find($instructionalMaterialId);
        
        Evaluation::create([
            'matrix_id' => $matrixId,
            'material_id' => $instructionalMaterialId,
            'evaluator_id' => $user->id,
            'passed_criteria' => $request->input('passed_criteria'),
            'comment' => $request->input('comment'),
            'status' => $status,
        ]);

        if ($universityRole == 3 && $role == 3){
            if ($status == 'passed') {
                $instructionalMaterial->update([
                    'status' => 'approved',
                ]); 

                // Todo: GENERATE A RECORD REPORT display additional form in blade if role is vp 
            } else {
                $instructionalMaterial->update([
                    'status' => 'resubmission',
                ]); 
            }
        } else {
            if ($status == 'passed') {
                $passedEvaluationsCount = Evaluation::where('material_id', $instructionalMaterialId)
                    ->where('matrix_id', $matrixId)
                    ->where('status', 'passed')
                    ->count();
            
                $totalEvaluatorMatrixCount = EvaluatorMatrix::where('matrix_id', $matrixId)->count();
                
                if ($passedEvaluationsCount == $totalEvaluatorMatrixCount) {
                    $evaluationStage = EvaluationStage::where('matrix_id', $matrixId)
                        ->where('material_id', $instructionalMaterialId)
                        ->first();
            
                    if ($evaluationStage) {
                        $evaluationStage->increment('stage');
                    
                        $evaluationStageStage = $evaluationStage->stage;
                        $newMatrixStage = Matrix::where('stage', $evaluationStageStage)->first();
                    
                        if ($newMatrixStage) {
                            $evaluationStage->update([
                                'matrix_id' => $newMatrixStage->id,
                            ]);
                        }
                    }
                }
                
                $area = 'evaluator.evaluation_management'; 
                $title = 'New Material for Evaluation'; 
                $action = 'added'; 
                $description = $user->firstname . ' ' . $user->lastname . ' has given approval for the instructional material titled "' . $request->input('title') . '," advancing it to the next stage of evaluation.'; 
            
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

                $instructionalMaterial->update([
                    'status' => 'pending',
                ]); 
            } else {
                $instructionalMaterial->update([
                    'status' => 'resubmission',
                ]); 
            }
        }

        $area = 'submission_management'; 
        $title = 'Evaluation Submitted'; 
        $action = 'submitted'; 
        $description = $user->firstname . ' ' . $user->lastname . ' submitted an evaluation regarding your Instructional Material titled "' . $instructionalMaterial->title . '".'; 
        
        $submitterId = $instructionalMaterial->submitter_id;
        $submitter = User::findOrFail($submitterId);

        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($submitter, new SystemNotification($title, $action, $description, $area));    

        return redirect()->route('evaluator.evaluation_management')->with('success', 'Evaluation submitted successfully!');
    }
}
