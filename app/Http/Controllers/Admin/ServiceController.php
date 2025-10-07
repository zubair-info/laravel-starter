<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    //
    public function index()
    {
        // Return the Inertia page located at resources/js/pages/Service.vue
        return Inertia::render('Admin/Service/Index', []);
    }
}
