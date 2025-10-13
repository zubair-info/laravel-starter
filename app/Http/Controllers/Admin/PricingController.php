<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PricingController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/pricings/index', [
            'pricings' => Pricing::orderBy('id')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'hours' => 'required|integer',
            'per_week' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Pricing::create($data);

        return redirect()->back()->with('success', 'Pricing plan added.');
    }

    public function update(Request $request, Pricing $pricing)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'hours' => 'required|integer',
            'per_week' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $pricing->update($data);

        return redirect()->back()->with('success', 'Pricing plan updated.');
    }

    public function destroy(Pricing $pricing)
    {
        $pricing->delete();

        return redirect()->back()->with('success', 'Pricing plan deleted.');
    }
}
