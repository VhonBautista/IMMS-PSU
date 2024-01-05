<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $universityRoleFilter = $request->university_role;

        $campus = Campus::query();

        if ($searchFilter) {
            $campus->where(function($query) use ($searchFilter) {
                $query->where('campus_name', 'like', "%{$searchFilter}%")
                    ->orWhere('location', 'like', "%{$searchFilter}%");
            });
        }

        $campuses = $campus->orderBy('campus_name', 'asc')->paginate(10);

        // if ($searchFilter) {
        //     $matrices->where(function ($query) use ($searchFilter) {
        //         $query->where('matrix_name', 'like', "%{$searchFilter}%");
        //     });
        // }

        // if ($universityRoleFilter) {
        //     $matrices->whereHas('evaluatorMatrices', function ($query) use ($universityRoleFilter) {
        //         $query->where('univ_role_id', $universityRoleFilter);
        //     });
        // }

        // $matrices = $matrices->orderBy('matrix_name', 'asc')->paginate(10);

        return view('user.submission-management', compact('campuses'));
    }
}
