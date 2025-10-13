<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'company', 'start_date', 'end_date', 'description'
    ];
    protected $casts = [
        'start_date' => 'date',  // Laravel will handle 'YYYY-MM-DD'
        'end_date'   => 'date',
    ];

    // Mutator for start_date
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('Y-m-d', strtotime($value));
    }

    // Mutator for end_date
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }


}
