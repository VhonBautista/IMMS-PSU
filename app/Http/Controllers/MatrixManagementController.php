<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Log;
use App\Models\User;
use App\Models\EvaluatorMatrix;
use App\Models\Matrix;
use App\Models\MatrixItem;
use App\Models\SubMatrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Database\QueryException;

class MatrixManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $levelFilter = $request->level;

        $matrices = Matrix::query();

        if ($searchFilter) {
            $matrices->where(function ($query) use ($searchFilter) {
                $query->where('matrix_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($levelFilter) {
            $matrices->where('level', $levelFilter);
        }

        $matrices = $matrices->orderBy('matrix_name', 'asc')->paginate(5);

        return view('admin.matrix-management', compact('matrices'));
    }

    public function getUniversityRolesForMatrix()
    {
        $evaluators = User::whereDoesntHave('evaluatorMatrix')
        ->where('role_id', 3)
        ->orderBy('lastname', 'asc')
        ->get();

        return view('admin.matrix-modal', compact('evaluators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matrix_name' => 'required|string|max:255',
            'description' => 'required',
            'level' => 'required',
        ]);

        $matricesCount = Matrix::count() + 1;

        Matrix::create([
            'matrix_name' => $request->input('matrix_name'),
            'description' => $request->input('description'),
            'level' => $request->input('level'),
            'stage' => $matricesCount,
        ]);

        // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'New Matrix added';
            $action = 'added';
            $description = $user->firstname . ' ' . $user->lastname . '  added a new matrix "' . $request->input('matrix_name') . '".'; 
            
            // Reciever of Notification
            $users = User::where('role_id', 1)->get();
    
            // Log & Notification
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        // =============================== Log & Notification Details End ===============================//

        return redirect()->route('admin.matrix_management')->with('success', 'Matrix added successfully.');
    }

    public function storeEvaluator(Request $request)
    {
        $request->validate([
            'matrix_id' => 'required|numeric',
            'evaluator_ids' => 'required|array',
            'evaluator_ids.*' => 'numeric|exists:users,id',
        ]);

        $matrixId = $request->matrix_id;
        $evaluatorIds = $request->evaluator_ids;

        $matrix = Matrix::findOrFail($matrixId);

        $evaluatorCount = count($evaluatorIds);
        $existingEvaluatorsCount = EvaluatorMatrix::where('matrix_id', $matrixId)->count();
        $totalCount = $evaluatorCount + $existingEvaluatorsCount;

        if ($totalCount > 3) {
            return redirect()
                ->route('admin.matrix_management.manage', $matrixId)
                ->with('detail-error', 'Cannot add more than three evaluators per matrix.');
        }

        foreach ($evaluatorIds as $evaluatorId) {
            EvaluatorMatrix::create([
                'matrix_id' => $matrixId,
                'evaluator_id' => $evaluatorId,
            ]);
        }

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Evaluator Added';
            $action = 'added';
            $description = $user->firstname . ' ' . $user->lastname . 'New Evaluator added in"' . $matrix->matrix_name . '".'; 
                
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with('detail-success', 'Evaluator(s) added successfully.');
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'matrix_id' => 'required|numeric',
            'sub_matrix_id' => 'required|numeric',
            'matrix_item_name' => 'required|string',
            'description' => 'required',
        ]);

        $matrixId = $request->matrix_id;
        $subMatrixId = $request->sub_matrix_id;
        $matrixItemName = $request->matrix_item_name;
        $description = $request->description;

        MatrixItem::create([
            'item' => $matrixItemName,
            'text' => $description,
            'sub_matrix_id' => $subMatrixId,
        ]);

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Matrix item Added';
            $action = 'added';
            $description = $user->firstname . ' ' . $user->lastname . 'New matrix item added.'; 
            
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with('detail-success', 'Item added successfully.');
    }

    public function storeTitle(Request $request)
    {
        $request->validate([
            'matrix_id' => 'required|numeric',
            'sub_matrix_name' => 'required|string',
        ]);

        $matrixId = $request->matrix_id;
        $subMatrixName = $request->sub_matrix_name;

        SubMatrix::create([
            'title' => $subMatrixName,
            'matrix_id' => $matrixId,
        ]);

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Title Added';
            $action = 'added';
            $description = $user->firstname . ' ' . $user->lastname . ' has added a title'; 
            
            $users = User::where('role_id', 1)->get();
           
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with('detail-success', 'Title added successfully.');
    }

    public function manage($id)
    {
        $matrix = Matrix::findOrFail($id);

        return view('admin.matrix-manage', compact('matrix'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'matrix_id' => 'required',
            'matrix_name' => 'required|string|max:255',
            'description' => 'required',
            'level' => 'required',
        ]);

        $matrix = Matrix::findOrFail($request->input('matrix_id'));

        $matrix->update([
            'matrix_name' => $request->input('matrix_name'),
            'description' => $request->input('description'),
            'level' => $request->input('level'),
        ]);

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Matrix Updated';
            $action = 'updated';
            $description = $user->firstname . ' ' . $user->lastname . ' updated the matrix information of "' . $request->input('matrix_name') . '".'; 
            
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        return redirect()->route('admin.matrix_management.manage', $request->input('matrix_id'))->with('success', 'Matrix updated successfully.');
    }

    public function remove(Request $request, $evaluatorId, $matrixId)
    {
        $evaluatorMatrix = EvaluatorMatrix::where('evaluator_id', $evaluatorId)
                                   ->where('matrix_id', $matrixId)
                                   ->firstOrFail();
        $evaluator = $evaluatorMatrix->evaluator;
        $matrix = $evaluatorMatrix->matrix;

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Evaluator Removed';
            $action = 'removed';
            $description = $user->firstname . ' ' . $user->lastname . ' removed ' . $evaluator->lastname . ', ' . $evaluator->firstname . ' from the matrix "' . $matrix->matrix_name . '".'; 
            
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        $evaluatorMatrix->delete();

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with('detail-success', 'Evaluator removed successfully.');
    }

    public function removeItem(Request $request, $matrixItemId, $matrixId)
    {
        $matrixItem = MatrixItem::findOrFail($matrixItemId);
        $matrix = $matrixItem->subMatrix->matrix;
        
        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Item Removed';
            $action = 'removed';
            $description = $user->firstname . ' ' . $user->lastname . ' removed ' . $matrixItem->item . ' from the matrix "' . $matrix->matrix_name . '".'; 
            
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        $matrixItem->delete();

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with(
            'detail-success', 'Item removed successfully.',
        );
    }

    public function destroyTitle(Request $request)
    {
        $request->validate([
            'sub_matrix_id' => ['required'],
            'matrix_id' => ['required'],
        ]);

        $subMatrix = SubMatrix::findOrFail($request->sub_matrix_id);
        $matrix = $subMatrix->matrix;

        $user = $request->user();
        if ($user->id != 1){
            $area = 'admin.matrix_management';
            $title = 'Title Removed';
            $action = 'removed';
            $description = $user->firstname . ' ' . $user->lastname . ' removed ' . $subMatrix->title . ' from the matrix "' . $matrix->matrix_name . '".'; 
            
            $users = User::where('role_id', 1)->get();
    
            Log::create([
                'area' => $area , 
                'title' => $title,
                'action' => $action,
                'description' => $description,
                'user_id' => $user->id, // ! Do not change
            ]);
            Notification::send($users, new SystemNotification($title, $action, $description, $area));
        }

        $subMatrix->matrixItems->each(function ($matrixItem) {
            $matrixItem->delete();
        });

        $subMatrix->delete();

        return redirect()->route('admin.matrix_management.manage', $request->matrix_id)->with(
            'detail-success', 'Sub matrix deleted successfully.',
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'matrix_id' => ['required'],
        ]);

        try {
            $matrix = Matrix::findOrFail($request->matrix_id);
            
            // Deleting evaluator matrices
            $matrix->evaluatorMatrices->each(function ($evaluatorMatrix) {
                $evaluatorMatrix->delete();
            });

            // Deleting sub matrices and their items
            $matrix->subMatrices->each(function ($subMatrix) {
                $subMatrix->matrixItems->each(function ($matrixItem) {
                    $matrixItem->delete();
                });

                $subMatrix->delete();
            });

            $user = $request->user();
            if ($user->id != 1){
                $area = 'admin.matrix_management';
                $title = 'Matrix Deleted';
                $action = 'deleted';
                $description = $user->firstname . ' ' . $user->lastname . ' deleted the Matrix "' . $matrix->matrix_name . '".'; 
                
                // Reciever of Notification
                $users = User::where('role_id', 1)->get();

                // Log & Notification
                Log::create([
                    'area' => $area , 
                    'title' => $title,
                    'action' => $action,
                    'description' => $description,
                    'user_id' => $user->id, // ! Do not change
                ]);
                Notification::send($users, new SystemNotification($title, $action, $description, $area));
            }

            // Deleting the main matrix
            $matrix->delete();

            return redirect()->route('admin.matrix_management')->with(
                'success', 'Matrix deleted successfully.',
            );
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Cannot delete matrix. Other instructional materials are still associated with this matrix.');
        }
    }
}
