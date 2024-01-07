<?php

namespace App\Http\Controllers;

use App\Models\EvaluationStage;
use App\Models\InstructionalMaterial;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        // Auth User ID
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
      
        $forEvaluationMaterials = $forEvaluationMaterials
        ->where('matrix_id', $matrixId)
        ->join('instructional_materials', 'evaluation_stages.material_id', '=', 'instructional_materials.id')
        ->whereHas('instructionalMaterial', function ($query) {
            $query->where('status', 'pending');
        })
        ->with(['instructionalMaterial'])
        ->orderBy('instructional_materials.updated_at', 'asc')
        ->select('evaluation_stages.*')
        ->paginate(10);

        return view('evaluator.evaluation-management', compact('forEvaluationMaterials', 'user'));
    }
}
