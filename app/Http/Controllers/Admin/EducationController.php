<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('start_date', 'desc')->get();
        return Inertia::render('admin/education/index', compact('educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Education::create($request->all());

        return redirect()->back()->with('success', 'Education created successfully.');
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $education->update($request->all());

        return redirect()->back()->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully.');
    }
}
