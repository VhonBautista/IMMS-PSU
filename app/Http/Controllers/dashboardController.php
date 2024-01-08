<?php

namespace App\Http\Controllers;
use App\Models\InstructionalMaterial;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Department;
use App\Models\College;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request)
{
    $startDate = $request->input('start_date', null);
    $endDate = $request->input('end_date', null);

    $query = InstructionalMaterial::selectRaw('DATE(created_at) as date, COUNT(*) as count');

    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    $imsPerDay = $query->groupByRaw('DATE(created_at)')->get();

    $courseCount = Course::count();
    $departmentCount = Department::count();
    $collegeCount = College::count();
    $campusCount = Campus::count();

    return view('admin.dashboard', compact('imsPerDay', 'startDate', 'endDate','courseCount', 'departmentCount', 'collegeCount', 'campusCount'));
}

  
}
