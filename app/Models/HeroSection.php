<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HeroSection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $appends=['image_url'];

    protected $fillable = [
        'greeting_text',
        'greeting_icon',
        'title_first',
        'title_second',
        'subtitle',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'hero_image',
        'rotating_svg',
        'client_count',
        'client_label',
        'status',
    ];

    public function socialLinks()
    {
        return $this->hasMany(HeroSocialLinks::class);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_images')->singleFile();
    }
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('hero_images');
    }
}
