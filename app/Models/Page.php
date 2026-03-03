<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'show_carousel',
        'is_home',
        'featured_image',
        'show_novidades',
    ];

    /**
     * URL pública da imagem de rosto/destaque (quando não usa carrossel).
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    protected $casts = [
        'show_carousel' => 'boolean',
        'is_home' => 'boolean',
        'show_novidades' => 'boolean',
    ];

    /**
     * Scope para obter a página inicial.
     */
    public function scopeHome($query)
    {
        return $query->where('is_home', true);
    }
}
