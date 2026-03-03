<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CarouselImage extends Model
{
    use HasFactory;

    protected $fillable = ['carousel_id', 'path', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];

    public function carousel()
    {
        return $this->belongsTo(Carousel::class);
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    protected static function booted()
    {
        static::deleting(function (CarouselImage $image) {
            Storage::disk('public')->delete($image->path);
        });
    }
}
