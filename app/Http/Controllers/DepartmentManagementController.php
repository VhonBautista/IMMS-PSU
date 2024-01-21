<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Campus;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;

class DepartmentManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $user = $request->user();
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $campuses = Campus::orderBy('campus_name', 'asc')->get();
        $departments = Department::query();

        if ($searchFilter) {
            $departments->where(function ($query) use ($searchFilter) {
                $query->where('department_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($campusFilter) {
            $departments->where('campus_id', $campusFilter);
        }

        $departments = $departments->orderBy('department_name', 'asc')->paginate(10);

        return view('admin.department-management', compact('departments', 'campuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        Department::create([
            'department_name' => $request->input('department_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        $user = $request->user();
        $area = 'admin.department_management'; 
        $title = 'New department Added'; 
        $action = 'added'; 
        $description = $user->firstname . ' ' . $user->lastname . ' added a new department "' . $request->input('department_name') . '".';
        
        $users = User::where('role_id', 1)->get();
        
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        return redirect()->route('admin.department_management')->with('success', 'Department added successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $campuses = Campus::orderBy('campus_name', 'asc')->get();

        return view('admin.department-edit', compact('department','campuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required',
        ]);

        $department = Department::findOrFail($request->input('department_id'));

        $department->update([
            'department_name' => $request->input('department_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        $user = $request->user();
        $area = 'admin.department_management'; 
        $title = ' department Information Updated '; 
        $action = 'updated'; 
        $description = $user->firstname . ' ' . $user->lastname . ' updated the department infromation of "' . $request->input('department_name') . '".';
        
        $users = User::where('role_id', 1)->get();
        
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        return redirect()->route('admin.department_management.edit', $request->input('department_id'))->with('success', 'Department updated successfully.');
    }

    public function destroy(request $request)
    {
        $request->validate([
            'department_id' => ['required'],
        ]);

        $department = Department::findOrFail($request->department_id);
        $department->delete();

         $user = $request->user();
        $area = 'admin.department_management'; 
        $title = ' department deleted'; 
        $action = 'deleted'; 
        $description = $user->firstname . ' ' . $user->lastname . ' deleted the department "' . $department->department_name . '".';
        
        $users = User::where('role_id', 1)->get();

        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));
        
        return redirect()->route('admin.department_management')->with(
            'success', 'Department deleted successfully.',
        );
    }
}
