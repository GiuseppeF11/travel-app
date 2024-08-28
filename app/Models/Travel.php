<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'start_date',
        'end_date',
        'location',
        'description',
        'img_file',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function getImgUrlAttribute()
    {
        return Storage::url($this->attributes['img_file']);
    }
}
