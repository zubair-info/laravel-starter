<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return Inertia::render('admin/skills/index', [
            'skills' => $skills
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level_percent' => 'required|integer|min:0|max:100',
            'icon_path' => 'nullable|string|max:255'
        ]);

        Skill::create($request->all());

        return redirect()->back()->with('success', 'Skill added successfully.');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level_percent' => 'required|integer|min:0|max:100',
            'icon_path' => 'nullable|string|max:255'
        ]);

        $skill->update($request->all());

        return redirect()->back()->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->back()->with('success', 'Skill deleted successfully.');
    }
}
