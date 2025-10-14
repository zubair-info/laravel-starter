<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Inertia\Inertia;

class AboutController extends Controller
{
    /**
     * Display all About sections
     */
    public function index()
    {
        $abouts = About::all();

        // return Inertia page with all sections
        return Inertia::render('admin/about/index', [
            'abouts' => $abouts
        ]);
    }

    /**
     * Store a new About section
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'greeting' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|max:255',
            'language' => 'required|string|max:255',
            'freelance' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'resume_link' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer',
            'award_count' => 'nullable|integer',
            'client_count' => 'nullable|integer',
            'job_done' => 'nullable|integer',
            'image' => 'nullable|max:2048', // media file
        ]);

        $about = About::create($data);

        if ($request->hasFile('image')) {
            $about->addMedia($request->file('image'))->toMediaCollection('about_images');
        }

        return redirect()->route('admin.about.index')
            ->with('success', 'About section created successfully!');
    }

    /**
     * Update a specific About section
     */
    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'greeting' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|max:255',
            'language' => 'required|string|max:255',
            'freelance' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'resume_link' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer',
            'award_count' => 'nullable|integer',
            'client_count' => 'nullable|integer',
            'job_done' => 'nullable|integer',
            'image' => 'nullable|max:2048', // media file
        ]);

        $about->update($data);

        if ($request->hasFile('image')) {
            $about->clearMediaCollection('about_images'); // remove old image
            $about->addMedia($request->file('image'))->toMediaCollection('about_images');
        }

        return redirect()->route('admin.about.index')
            ->with('success', 'About section updated successfully!');
    }

    /**
     * Delete an About section
     */
    public function destroy(About $about)
    {
        $about->clearMediaCollection('about_images'); // remove images
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About section deleted successfully!');
    }
}
