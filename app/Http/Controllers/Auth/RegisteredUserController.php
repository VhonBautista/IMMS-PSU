<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Log;
use App\Models\UniversityRole;
use App\Models\User;
use App\Notifications\SystemNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $universityRoles = UniversityRole::orderBy('university_role', 'asc')->get();
        $campuses = Campus::orderBy('campus_name', 'asc')->get();
    
        return view('auth.register', compact('universityRoles', 'campuses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'university_role' => ['required'],
            'campus' => ['required'],
        ]);

        if (!Str::endsWith($request->email, '@psu.edu.ph')) {
            return redirect()->back()->with('error', 'The email must end with @psu.edu.ph')->withInput();
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 4,
            'univ_role_id' => $request->university_role,
            'campus_id' => $request->campus,
        ]);

        event(new Registered($user));
        Auth::login($user);

        // =============================== Log & Notification ===============================//
        // Information Details
        $area = 'admin.user_management';
        $title = 'New User Registered';
        $action = 'registered';
        $description = $user->firstname . ' ' . $user->lastname . ' just created their account.'; 

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

        return redirect(RouteServiceProvider::HOME);
    }
}
