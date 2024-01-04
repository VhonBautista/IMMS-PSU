<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\User;
use App\Models\EvaluatorMatrix;
use App\Models\Matrix;
use App\Models\MatrixItem;
use App\Models\SubMatrix;
use App\Models\UniversityRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
class MatrixManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $universityRoleFilter = $request->university_role;

        $universityRoles = UniversityRole::all();
        $matrices = Matrix::query();

        if ($searchFilter) {
            $matrices->where(function ($query) use ($searchFilter) {
                $query->where('matrix_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($universityRoleFilter) {
            $matrices->whereHas('evaluatorMatrices', function ($query) use ($universityRoleFilter) {
                $query->where('univ_role_id', $universityRoleFilter);
            });
        }

        $matrices = $matrices->orderBy('matrix_name', 'asc')->paginate(5);

        return view('admin.matrix-management', compact('matrices', 'universityRoles'));
    }

    public function getUniversityRolesForMatrix($matrixId)
    {
        $matrix = Matrix::findOrFail($matrixId);

        $universityRoles = UniversityRole::whereDoesntHave('evaluatorMatrices', function ($query) use ($matrixId) {
            $query->where('matrix_id', $matrixId);
        })
        ->orderBy('university_role', 'asc')
        ->get();

        return view('admin.matrix-modal', compact('universityRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matrix_name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Matrix::create([
            'matrix_name' => $request->input('matrix_name'),
            'description' => $request->input('description'),
        ]);

          // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
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

        // =============================== Log & Notification Details End ===============================//

        return redirect()->route('admin.matrix_management')->with('success', 'Matrix added successfully.');
    }

    public function storeEvaluator(Request $request)
    {
        $request->validate([
            'matrix_id' => 'required|numeric',
            'univ_role_ids' => 'required|array',
            'univ_role_ids.*' => 'numeric|exists:university_roles,id',
        ]);

        $matrixId = $request->matrix_id;
        $univRoleIds = $request->univ_role_ids;

        $matrix = Matrix::findOrFail($matrixId);

        foreach ($univRoleIds as $univRoleId) {
            EvaluatorMatrix::create([
                'matrix_id' => $matrixId,
                'univ_role_id' => $univRoleId,
            ]);
        }
  $user = $request->user();
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
        ]);

        $matrix = Matrix::findOrFail($request->input('matrix_id'));

        $matrix->update([
            'matrix_name' => $request->input('matrix_name'),
            'description' => $request->input('description')
        ]);

        
        $user = $request->user();
        $area = 'admin.matrix_management';
        $title = 'matrix Updated';
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

        return redirect()->route('admin.matrix_management.manage', $request->input('matrix_id'))->with('success', 'Matrix updated successfully.');
    }

    public function remove($universityRoleId, $matrixId)
    {
        $evaluatorMatrix = EvaluatorMatrix::where('univ_role_id', $universityRoleId)
                                   ->where('matrix_id', $matrixId)
                                   ->firstOrFail();

        $evaluatorMatrix->delete();

        

        return redirect()->route('admin.matrix_management.manage', $matrixId)->with('detail-success', 'Evaluator removed successfully.');
    }

    public function removeItem($matrixItemId, $matrixId)
    {
        $matrixItem = MatrixItem::findOrFail($matrixItemId);

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

        $subMatrix->matrixItems->each(function ($matrixItem) {
            $matrixItem->delete();
        });

        $subMatrix->delete();

        $user = $request->user();
        $area = 'admin.matrix_management';
        $title = 'title Deleted';
        $action = 'deleted';
        $description = $user->firstname . ' ' . $user->lastname . ' deleted the title "' . $subMatrix->title . '".'; 
        
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

        return redirect()->route('admin.matrix_management.manage', $request->matrix_id)->with(
            'detail-success', 'Sub matrix deleted successfully.',
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'matrix_id' => ['required'],
        ]);

        $matrix = Matrix::findOrFail($request->matrix_id);
        
        $matrix->evaluatorMatrices->each(function ($evaluatorMatrix) {
            $evaluatorMatrix->delete();
        });

        $matrix->subMatrices->each(function ($subMatrix) {
            $subMatrix->matrixItems->each(function ($matrixItem) {
                $matrixItem->delete();
            });

            $subMatrix->delete();
        });

        $matrix->delete();

        
        $user = $request->user();
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

        return redirect()->route('admin.matrix_management')->with(
            'success', 'Matrix deleted successfully.',
        );
    }
}
