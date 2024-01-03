<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $actionFilter = $request->action;

        $logs = Log::query();

        if ($searchFilter) {
            $logs->where(function($query) use ($searchFilter) {
                $query->where('title', 'like', "%{$searchFilter}%")
                    ->orWhere('description', 'like', "%{$searchFilter}%");
            });
        }

        if ($actionFilter) {
            $logs->where('action', $actionFilter);
        }

        $logs = $logs->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.log', compact('logs'));
    }
}
