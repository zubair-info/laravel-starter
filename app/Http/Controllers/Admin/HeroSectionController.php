<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::get();
        return Inertia::render('admin/hero/index', [
            'heroes' => $heroes
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/hero/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'greeting_text' => 'nullable|string',
            'title_first' => 'required|string|max:255',
            'title_second' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string',
            'primary_button_url' => 'nullable|string',
            'secondary_button_text' => 'nullable|string',
            'secondary_button_url' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'client_count' => 'nullable|string',
            'client_label' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        // if ($request->hasFile('hero_image')) {
        //     $file = $request->file('hero_image');
        //     // Generate unique file name
        //     $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //     // Move file to public folder
        //     $file->move(public_path('images/hero'), $filename);
        //     // Store relative path in DB
        //     $data['hero_image'] = 'images/hero/' . $filename;
        // }


        $hero = HeroSection::create($data);
        if ($request->hasFile('hero_image')) {
            $hero->addMedia($request->file('hero_image'))
                ->toMediaCollection('hero_images');
        }

        return redirect()->route('admin.hero.index')->with('success', 'Hero section created');
    }

    public function edit(HeroSection $hero)
    {
        return Inertia::render('admin/hero/edit', [
            'hero' => $hero
        ]);
    }

    public function update(Request $request, HeroSection $hero)
    {

        $data = $request->validate([
            'greeting_text' => 'nullable|string',
            'title_first' => 'required|string|max:255',
            'title_second' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string',
            'primary_button_url' => 'nullable|string',
            'secondary_button_text' => 'nullable|string',
            'secondary_button_url' => 'nullable|string',
            'hero_image' => 'nullable|image|max:2048',
            'client_count' => 'nullable|string',
            'client_label' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);


        $hero->update($data);
        if ($request->hasFile('hero_image')) {
            $hero->clearMediaCollection('hero_images');

            // Add new image
            $hero->addMediaFromRequest('hero_image')
                ->toMediaCollection('hero_images');
        }

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated');
    }

    public function destroy(HeroSection $hero)
    {
        $hero->delete();
        return back()->with('success', 'Hero section deleted');
    }
}
