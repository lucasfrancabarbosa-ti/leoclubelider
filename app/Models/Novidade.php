<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Novidade extends Model
{
    use HasFactory;

    protected $table = 'novidades';

    protected $fillable = ['title', 'description', 'image', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    protected static function booted(): void
    {
        static::deleting(function (Novidade $novidade) {
            if ($novidade->image && Storage::disk('public')->exists($novidade->image)) {
                Storage::disk('public')->delete($novidade->image);
            }
        });
    }
}
