<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\HeroSocialLink;
use App\Models\HeroSocialLinks;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        $hero = HeroSection::create([
            'greeting_text' => "Hello, I’m",
            'title_first' => "Mark",
            'title_second' => "Henry",
            'subtitle' => "Product Designer | Based in Germany",
            'primary_button_text' => "Let's Talk",
            'primary_button_url' => "/contact",
            'secondary_button_text' => "My Work",
            'secondary_button_url' => "/projects",
            'hero_image' => "/uploads/hero/hero.png",
            'client_count' => "1.2k+",
            'client_label' => "Worldwide client",
            'status' => 'active',
        ]);

        HeroSocialLinks::insert([
            [
                'hero_section_id' => $hero->id,
                'platform' => 'LinkedIn',
                'icon_svg' => '<svg>...</svg>',
                'url' => 'https://linkedin.com/in/markhenry',
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'hero_section_id' => $hero->id,
                'platform' => 'GitHub',
                'icon_svg' => '<svg>...</svg>',
                'url' => 'https://github.com/markhenry',
                'sort_order' => 2,
                'status' => 'active',
            ],
        ]);
    }
}
