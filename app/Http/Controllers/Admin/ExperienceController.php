<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::latest()->get();
        return Inertia::render('admin/experience/index', [
            'experiences' => $experiences,
        ]);
    }

    public function store(Request $request)
    {
        // dd( $request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Experience::create($request->all());

        return redirect()->back()->with('success', 'Experience added successfully.');
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $experience->update($request->all());

        return redirect()->back()->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->back()->with('success', 'Experience deleted successfully.');
    }
}
