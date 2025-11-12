<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'path',
        'thumbnail_path',
        'approved',
        'views_count',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getVideoUrlAttribute()
    {
        return asset('storage/'.$this->path);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? asset('storage/'.$this->thumbnail_path) : null;
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('approved', false);
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }
}