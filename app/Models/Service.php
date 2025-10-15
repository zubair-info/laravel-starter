<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'link',
    ];

    protected $appends = ['service_icons'];

    public function getServiceIconsAttribute()
    {
        return $this->getFirstMediaUrl('service_icons');
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
