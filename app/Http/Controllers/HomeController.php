<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function index()
    {
        $hero = HeroSection::first();
        $specialties = Specialty::first();
        $services = Service::all();
        $about = About::first();
        $skills = Skill::all();
        $educations = Education::all();
        $experiences = Experience::all();

        return Inertia::render('frontend/Home', [
            'logo' => asset('assets/images/logo/logo.png'),
            'offcanvasLogo' => asset('assets/images/logo/offcanvas-logo.png'),
            'headerMenu' => [
                ['label' => 'Home', 'url' => route('home')],
                // ['label' => 'About', 'url' => route('about')],
                // ['label' => 'Projects', 'url' => route('projects')],
                // ['label' => 'Blog', 'url' => route('blog')],
                // ['label' => 'Contact', 'url' => route('contact')],
            ],
            'socialLinks' => [
                ['icon' => 'linkedin', 'url' => 'https://linkedin.com'],
                ['icon' => 'facebook', 'url' => 'https://facebook.com'],
                ['icon' => 'twitter', 'url' => 'https://twitter.com'],
                ['icon' => 'github', 'url' => 'https://github.com'],
            ],
            'hero' => $hero,
            'services' => $services,
            'specialties' => $specialties,
            'about' => $about,
            'skills' => $skills,
            'educations' => $educations,
            'experiences' => $experiences,
        ]);
    }
}
