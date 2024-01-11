<?php

namespace App\Http\Controllers;
use App\Models\InstructionalMaterial;
use App\Models\Course;
use App\Models\Department;
use App\Models\College;
use App\Models\Campus;
use App\Models\Matrix;
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
        
        $existingStage2Matrix = Matrix::where('level', 'university')->where('stage', 2)->exists();
        $existingStage4Matrix = Matrix::where('level', 'university')->where('stage', 4)->exists();

        if (!$existingStage2Matrix) {
            Matrix::create([
                'matrix_name' => 'Plagiarism Evaluation',
                'description' => 'The Plagiarism Evaluation Matrix is designed to assess instructional materials for the presence of plagiarized content. Plagiarism can undermine the integrity of educational resources and compromise the learning experience. This matrix focuses on identifying and mitigating instances of plagiarism in instructional materials, ensuring that the content is original, properly cited, and adheres to ethical standards.',
                'campus_id' => 1,
                'level' => 'university',
                'stage' => 2,
            ]);
        }

        if (!$existingStage4Matrix) {
            Matrix::create([
                'matrix_name' => 'Vice President Evaluation',
                'description' => 'The Vice President of Evaluation oversees the critical task of assessing instructional materials to ensure they meet the highest standards of quality and effectiveness. This role involves evaluating various educational resources, considering factors such as accuracy, alignment with learning objectives, and overall instructional value. The Vice President of Evaluation plays a key role in shaping the educational experience by ensuring that instructional materials contribute positively to the learning outcomes of students and educators alike.',
                'campus_id' => 1,
                'level' => 'university',
                'stage' => 4,
            ]);
        }

        return view('admin.dashboard', compact('imsPerDay', 'startFormatted', 'endFormatted','courseCount', 'departmentCount', 'collegeCount', 'campusCount'));
    }
}
