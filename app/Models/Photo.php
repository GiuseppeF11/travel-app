<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_id',
        'file_path',
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
