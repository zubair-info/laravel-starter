<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return inertia('admin/specialties/index', compact('specialties'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        Specialty::create($data);
        return redirect()->back()->with('success', 'Specialty created');
    }

    public function update(Request $request, Specialty $specialty)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        $specialty->update($data);
        return redirect()->back()->with('success', 'Specialty updated');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->back()->with('success', 'Specialty deleted');
    }
}
