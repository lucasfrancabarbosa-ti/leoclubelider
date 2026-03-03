<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuSetting extends Model
{
    protected $fillable = ['page_order', 'show_dashboard_link', 'logo'];

    protected $casts = [
        'page_order' => 'array',
        'show_dashboard_link' => 'boolean',
    ];

    /**
     * Retorna a instância única de configuração do menu (id = 1).
     */
    public static function get(): self
    {
        $setting = static::find(1);
        if (!$setting) {
            static::query()->insert([
                'id' => 1,
                'page_order' => json_encode([]),
                'show_dashboard_link' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $setting = static::find(1);
        }
        return $setting;
    }

    /**
     * Páginas do menu na ordem configurada.
     */
    public function getOrderedPages()
    {
        $order = $this->page_order ?? [];
        if (empty($order)) {
            return collect();
        }
        $pages = Page::whereIn('id', $order)->get()->keyBy('id');
        return collect($order)->map(fn ($id) => $pages->get($id))->filter();
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}
