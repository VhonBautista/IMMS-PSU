<?php

namespace App\Http\Controllers;
use App\Models\InstructionalMaterial;
use App\Models\Course;
use App\Models\Department;
use App\Models\College;
use App\Models\Campus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $startFilter = $request->input('start_date', null);
    $endFilter = $request->input('end_date', null);

    $startFormatted = $startFilter ? date('Y-m-d 00:00:00', strtotime($startFilter)) : null;
    $endFormatted = $endFilter ? date('Y-m-d 23:59:59', strtotime($endFilter)) : null;

    $query = InstructionalMaterial::selectRaw('DATE(created_at) as date, COUNT(*) as count');

    if ($startFilter && $endFilter) {
        $query->whereBetween('created_at', [$startFormatted, $endFormatted]);
    }

    $imsPerDay = $query->groupByRaw('DATE(created_at)')->get();

    $courseCount = Course::count();
    $departmentCount = Department::count();
    $collegeCount = College::count();
    $campusCount = Campus::count();

    return view('admin.dashboard', compact('imsPerDay', 'startFormatted', 'endFormatted','courseCount', 'departmentCount', 'collegeCount', 'campusCount'));
}

  
}
