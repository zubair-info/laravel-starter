<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $hero = HeroSection::with(['socialLinks' => function ($q) {
            $q->where('status', 'active')->orderBy('sort_order');
        }])->where('status', 'active')->first();

        return view('frontend.home', compact('hero'));
    }
}
