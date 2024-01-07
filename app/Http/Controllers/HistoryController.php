<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Auth User
        $user = $request->user();

        // Filters
        $searchFilter = $request->search;
        $startFilter = $request->start;
        $endFilter = $request->end;
        $startFormatted = date('Y-m-d 00:00:00', strtotime($startFilter));
        $endFormatted = date('Y-m-d 23:59:59', strtotime($endFilter));
        
        $evaluations = Evaluation::query();

        
        if ($searchFilter) {
            $evaluations->whereHas('instructionalMaterial.user', function ($query) use ($searchFilter) {
                $query->where('firstname', 'like', "%{$searchFilter}%")
                      ->orWhere('lastname', 'like', "%{$searchFilter}%")
                      ->orWhere('email', 'like', "%{$searchFilter}%");
            })->orWhereHas('instructionalMaterial', function ($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%");
            });
        }
        
        if ($startFilter && $endFilter) {
            $evaluations->whereBetween('created_at', [$startFormatted, $endFormatted]);
        }

        $evaluations = $evaluations->where('evaluator_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('evaluator.evaluation-history', compact('evaluations'));
    }
}
