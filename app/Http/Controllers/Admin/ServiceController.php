<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Repositories\BaseRepository;
use App\Models\Service;

class ServiceController extends Controller
{
    protected BaseRepository $repo;

    protected array $validationRules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        // 'service_icons' => 'nullable|image|max:2048',
        'link' => 'nullable|string|max:255',
    ];

    public function __construct()
    {
        $this->repo = new BaseRepository(new Service());
    }

    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $records =Service::get();
        // Return all services to Vue page
        return Inertia::render('admin/service/index', [
            'services' => $records,
        ]);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);
        //  dd($request->hasFile('service_icons'));
        $service = $this->repo->create($data);
        if ($request->hasFile('service_icons')) {

            $service->addMediaFromRequest('service_icons')->toMediaCollection('service_icons');
        }
        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate($this->validationRules);

        $service = $this->repo->update($id, $data);

        if (!$service) {
            return redirect()->route('admin.services.index')
                ->with('error', 'Service not found.');
        }
        if ($request->hasFile('service_icons')) {
            $service->clearMediaCollection('service_icons');
            $service->addMediaFromRequest('service_icons')->toMediaCollection('service_icons');
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy($id)
    {
        $deleted = $this->repo->delete($id);

        if (!$deleted) {
            return redirect()->route('services.index')
                ->with('error', 'Service not found.');
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Optional: Return single service (used for edit modal if needed)
     */
    public function show($id)
    {
        $service = $this->repo->find($id);

        if (!$service) {
            return redirect()->route('adminservices.index')
                ->with('error', 'Service not found.');
        }

        return Inertia::render('Admin/Service/Show', [
            'service' => $service,
        ]);
    }
}
