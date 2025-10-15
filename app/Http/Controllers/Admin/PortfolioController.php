<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('service')->latest()->get();
        return inertia('admin/portfolio/index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'service_id'    => 'nullable',
            'client'      => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
            'overview'    => 'nullable|string',
            'typography'  => 'nullable|string',
            'conclusion'  => 'nullable|string',
            'status'  => 'nullable|string',
            'main_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $validated['slug'] = Str::slug($request->title);
        $portfolio = Portfolio::create($validated);

        if ($request->hasFile('main_image')) {
            $portfolio->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio updated successfully.');
    }
    public function create()
    {
        $services = Service::all();
        return Inertia::render('admin/portfolio/form', [
            'services' => $services,
            'portfolio' => null
        ]);
    }


    public function update(Request $request, Portfolio $portfolio)
    {
        // For debugging
        // dd($request->all());

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'service_id'  => 'nullable',
            'client'      => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
            'overview'    => 'nullable|string',
            'typography'  => 'nullable|string',
            'conclusion'  => 'nullable|string',
            'status'      => 'nullable|string',
            // 'main_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update text fields
        $portfolio->update($validated);

        // Check correct field for file
        if ($request->hasFile('main_image')) {
            // Clear previous image
            // $portfolio->clearMediaCollection('main_image');

            // Add new image
            $portfolio->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        }

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio updated successfully.');
    }
    public function edit(Portfolio $portfolio)
    {
        $services = Service::all();
        return Inertia::render('admin/portfolio/form', [
            'portfolio' => $portfolio,
            'services' => $services
        ]);
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return back()->with('success', 'Portfolio deleted successfully.');
    }
}
