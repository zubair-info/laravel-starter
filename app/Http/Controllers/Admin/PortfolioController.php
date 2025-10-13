<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return inertia('admin/portfolio/index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $portfolio = Portfolio::create($data);

        if ($request->hasFile('image')) {
            $portfolio->addMediaFromRequest('image')->toMediaCollection('portfolio_images');
        }

        return redirect()->back()->with('success', 'Portfolio added successfully.');
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $portfolio->update($data);

        if ($request->hasFile('image')) {
            $portfolio->clearMediaCollection('portfolio_images');
            $portfolio->addMediaFromRequest('image')->toMediaCollection('portfolio_images');
        }

        return redirect()->back()->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->back()->with('success', 'Portfolio deleted successfully.');
    }
}
