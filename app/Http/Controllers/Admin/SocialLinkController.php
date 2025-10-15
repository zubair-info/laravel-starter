<?php

// app/Http/Controllers/Admin/SocialLinkController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::with('about')->latest()->get();

        return inertia('admin/sociallinks/index', [
            'links' => $links
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:100',
            'icon'     => 'nullable|string|max:255',
            'url'      => 'required|url|max:255',
            // 'about_id' => 'required|exists:abouts,id',
        ]);

        SocialLink::create($data);

        return back()->with('success', 'Social link added successfully.');
    }

    public function update(Request $request, SocialLink $social_link)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:100',
            'icon'     => 'nullable|string|max:255',
            'url'      => 'required|url|max:255',
            // 'about_id' => 'required|exists:abouts,id',
        ]);

        $social_link->update($data);

        return back()->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $social_link)
    {
        $social_link->delete();
        return back()->with('success', 'Social link deleted.');
    }
}
