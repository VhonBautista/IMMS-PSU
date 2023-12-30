<?php

namespace App\Http\Controllers;
use App\Models\Campus;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollegeController extends Controller
{
 

public function index(Request $request)
{
    $user = $request->user();
    $searchFilter = $request->search;
    $campuses = Campus::all();
    $colleges = College::query();

    if ($searchFilter) {
        $colleges->where(function ($query) use ($searchFilter) {
            $query->where('college_name', 'like', "%{$searchFilter}%");
        });
    }

    $colleges = $colleges->orderBy('college_name', 'asc')->paginate(5);

    
    $colleges->getCollection()->transform(function ($college) {
        $college->description = Str::limit($college->description, $limit = 50, $end = '...');
        return $college;
    });

    return view('admin.college', compact('colleges','campuses'));
}

    public function store(Request $request)
    {
        $request->validate([
        'college_name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'campus_id' => 'required|exists:campuses,id',
    ]);

    College::create([
        'college_name' => $request->input('college_name'),
        'description' => $request->input('description'),
        'campus_id' => $request->input('campus_id'),
    ]);

    return redirect()->route('admin.college')->with('success', 'College added successfully.');
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'college_id' => ['required'],
        ]);

        $colege = College::findOrFail($request->id);
        $colege->delete();
        
        return redirect()->route('admin.college')->with('success', 'College deleted successfully.');
    }
    public function edit($id)
    {
        $college = College::findOrFail($id);
        $colleges = College::all();
        $campuses = Campus::all();

        return view('admin.college-edit', compact('college','colleges','campuses'));
    }
    public function update(Request $request)
    {
        $request->validate([
            
            'college_name' => 'required',
            'description' => 'required|string|max:255',
            'campus_id' => 'required|numeric',
        ]);

        $college = College::findOrFail($request->input('id'),);

        $college->update([
            'college_name' => $request->input('college_name'),
            'description' => $request->input('description'),
            'campus_id' => $request->input('campus_id'),
            'updated_at' =>now()
        ]);

       
            return redirect()->route('admin.college')->with('success', 'College Updated successfully.');
       
    }
}
