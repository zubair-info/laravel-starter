<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class About extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'greeting',
        'name',
        'email',
        'phone',
        'language',
        'freelance',
        'role',
        'location',
        'description',
        'resume_link',
        'years_experience',
        'award_count',
        'client_count',
        'address',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('about_images');
        return $media ? $media->getUrl() : null;
    }
    public function socialLinks()
    {
        return $this->hasMany(SocialLink::class);
    }
}
