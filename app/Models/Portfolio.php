<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $casts = [
        'start_date' => 'date',  // Laravel will handle 'YYYY-MM-DD'
        'end_date'   => 'date',
    ];

    protected $fillable = [
        'title',
        'slug',
        'service_id',
        'client',
        'start_date',
        'end_date',
        'main_image',
        'overview',
        'typography',
        'conclusion',
        'status',
    ];
    protected $appends = ['image_url'];

    // Return the first media image URL
    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('main_image');
        return $media ? $media->getUrl() : null;
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
