<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Log;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CampusManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;

        $campus = Campus::query();

        if ($searchFilter) {
            $campus->where(function($query) use ($searchFilter) {
                $query->where('campus_name', 'like', "%{$searchFilter}%")
                    ->orWhere('location', 'like', "%{$searchFilter}%");
            });
        }

        $campuses = $campus->orderBy('campus_name', 'asc')->paginate(10);

        return view('admin.campus-management', compact('campuses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'campus_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Campus::create([
            'campus_name' => $request->input('campus_name'),
            'location' => $request->input('location'),
        ]);
        
        // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
        $area = 'admin.campus_management'; // * change based management route not URL
        $title = 'New Campus Added'; // * change based on function
        $action = 'added'; // * change based on action if added, created, updated, etc.
        $description = $user->firstname . ' ' . $user->lastname . ' added a new campus "' . $request->input('campus_name') . '".'; // * Change and use a fitting description
        
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

        return redirect()->route('admin.campus_management')->with('success', 'Campus added successfully.');
    }

    public function edit($id)
    {
        $campus = Campus::findOrFail($id);

        return view('admin.campus-edit', compact('campus'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'campus_id' => 'required',
            'campus_name' => 'required|string|max:255',
            'location' => 'required|string',
        ]);

        $campus = Campus::findOrFail($request->input('campus_id'));

        $campus->update([
            'campus_name' => $request->input('campus_name'),
            'location' => $request->input('location'),
            'updated_at' => now()
        ]);

        // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
        $area = 'admin.campus_management';
        $title = 'Campus Information Updated';
        $action = 'updated';
        $description = $user->firstname . ' ' . $user->lastname . ' updated the campus information of "' . $request->input('campus_name') . '".'; 
        
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

        return redirect()->route('admin.campus_management.edit', $request->input('campus_id'))->with('success', 'Campus updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'campus_id' => ['required'],
        ]);

        $campus = Campus::findOrFail($request->campus_id);
        
        // =============================== Log & Notification ===============================//
        // Information Details
        $user = $request->user();
        $area = 'admin.campus_management';
        $title = 'Campus Deleted';
        $action = 'deleted';
        $description = $user->firstname . ' ' . $user->lastname . ' deleted the campus "' . $campus->campus_name . '".'; 
        
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

        $campus->delete();
    
        return redirect()->route('admin.campus_management')->with(
            'success', 'Campus deleted successfully.',
        );
    }
}