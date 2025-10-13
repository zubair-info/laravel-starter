<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $casts = [
        'start_date' => 'date',  // Laravel will handle 'YYYY-MM-DD'
        'end_date'   => 'date',
    ];

    protected $fillable = [
        'degree',
        'institution',
        'start_date',
        'end_date',
        'description'
    ];
}
