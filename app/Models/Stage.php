<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_id',
        'title',
        'stage_start_date',
        'stage_end_date',
        'start_time',
        'end_time',
        'description',
    ];

    protected $casts = [
        'stage_start_date' => 'datetime',
        'stage_end_date' => 'datetime',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
