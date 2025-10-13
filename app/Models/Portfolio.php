<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'link',
    ];

    protected $appends = ['image_url'];

    // Return the first media image URL
    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('portfolio_images');
        return $media ? $media->getUrl() : null;
    }
}
