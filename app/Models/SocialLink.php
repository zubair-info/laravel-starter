<?php
// app/Models/SocialLink.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'platform',
        'icon',
        'url',
        'about_id',
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
