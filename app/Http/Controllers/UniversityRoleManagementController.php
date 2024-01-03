<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\UniversityRole;

class UniversityRoleManagementController extends Controller
{
   public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        
        $university = UniversityRole::query();

        if ($searchFilter) {
            $university->where(function($query) use ($searchFilter) {
                $query->where('university_role', 'like', "%{$searchFilter}%")
                    ->orWhere('description', 'like', "%{$searchFilter}%");
            });
        }
        
        $university_roles = $university->orderBy('university_role', 'asc')->paginate(10);

        return view('admin.university-role-management', compact('university_roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_role' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        UniversityRole::create([
            'university_role' => $request->input('university_role'),
            'description' => $request->input('description'),
        ]);

      
        $user = $request->user();
        $area = 'admin.university_role_management'; 
        $title = 'New Role Added'; 
        $action = 'added';
        $description = $user->firstname . ' ' . $user->lastname . ' added a new Univrsity Role "' . $request->input('university_role') . '".'; // * Change and use a fitting description
        
       
        $users = User::where('role_id', 1)->get();

      
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

       

        return redirect()->route('admin.university_role_management')->with('success', 'University role added successfully.');
    }

    public function edit($id)
    {
        $university = UniversityRole::findOrFail($id);

        return view('admin.university-role-edit', compact('university'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'university_role' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $university = UniversityRole::findOrFail($request->input('id'),);

        $university->update([
            'university_role' => $request->input('university_role'),
            'description' => $request->input('description'),
        ]);

        $user = $request->user();
        $area = 'admin.university_role_management'; 
        $title = 'Role Updated'; 
        $action = 'updated';
        $description = $user->firstname . ' ' . $user->lastname . ' updated the information of Univrsity Role "' . $request->input('university_role') . '".'; // * Change and use a fitting description
        
       
        $users = User::where('role_id', 1)->get();

      
        Log::create([
            'area' => $area , 
            'title' => $title,
            'action' => $action,
            'description' => $description,
            'user_id' => $user->id, // ! Do not change
        ]);
        Notification::send($users, new SystemNotification($title, $action, $description, $area));

        if($university) {
            return redirect()->route('admin.university_role_management.edit', $request->input('id'))->with('success', 'University role information has been updated successfully.');
        } else {
            abort(500, 'Oops, something went wrong');
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        $university = UniversityRole::findOrFail($request->id);
        $university->delete();
        
          // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
        $area = 'admin.university_role_management';
        $title = 'Role Deleted';
        $action = 'deleted';
        $description = $user->firstname . ' ' . $user->lastname . ' deleted the Role "' . $university->university_role . '".'; 
        
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

        return redirect()->route('admin.university_role_management')->with('success', 'University role deleted successfully.');
    }
}
