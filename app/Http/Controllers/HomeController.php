<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Department;
use App\Models\InstructionalMaterial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Auth User
        $user = $request->user();

        // Filters
        $searchFilter = $request->search;
        $courseFilter = $request->course;
        $departmentFilter = $request->department;
        $campusFilter = $request->campus;
        $startFilter = $request->start;
        $endFilter = $request->end;

        $startFormatted = $startFilter ? date('Y-m-d 00:00:00', strtotime($startFilter)) : null;
        $endFormatted = $endFilter ? date('Y-m-d 23:59:59', strtotime($endFilter)) : null;
        
        $courses = Course::orderBy('course_name', 'asc')->get();
        $departments = Department::orderBy('department_name', 'asc')->get();
        $campuses = Campus::orderBy('campus_name', 'asc')->get();

        $instructionalMaterials = InstructionalMaterial::query();

        if ($searchFilter) {
            $instructionalMaterials->where(function ($query) use ($searchFilter) {
                $query->whereHas('user', function ($userQuery) use ($searchFilter) {
                    $userQuery->where('firstname', 'like', "%{$searchFilter}%")
                        ->orWhere('lastname', 'like', "%{$searchFilter}%")
                        ->orWhere('email', 'like', "%{$searchFilter}%");
                })
                ->orWhere('title', 'like', "%{$searchFilter}%");
            });
        }

        if ($courseFilter) {
            $instructionalMaterials->where('course_id', $courseFilter);
        }

        if ($departmentFilter) {
            $instructionalMaterials->where('department_id', $departmentFilter);
        }

        if ($campusFilter) {
            $instructionalMaterials->where('campus_id', $campusFilter);
        }

        if ($startFormatted && $endFormatted) {
            $instructionalMaterials->whereBetween('created_at', [$startFormatted, $endFormatted]);
        }

        $instructionalMaterials = $instructionalMaterials->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('home', compact('instructionalMaterials', 'courses', 'departments', 'campuses'));
    }

    public function view($materialId)
    {
        $instructionalMaterial = InstructionalMaterial::findOrFail($materialId);

        $evaluations = $instructionalMaterial->evaluations()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('view', compact('instructionalMaterial', 'evaluations'));
    }
}
