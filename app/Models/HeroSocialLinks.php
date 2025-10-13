<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HeroSocialLinks extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'hero_section_id',
        'platform',
        'icon_svg',
        'url',
        'sort_order',
        'status',
    ];

    public function heroSection()
    {
        return $this->belongsTo(HeroSection::class);
    }
}
