<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = ['copyright', 'social_links'];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function socialNetworks(): array
    {
        return [
            'facebook' => [
                'label' => 'Facebook',
                'icon' => 'bi-facebook',
                'placeholder' => 'https://facebook.com/sua-pagina',
            ],
            'instagram' => [
                'label' => 'Instagram',
                'icon' => 'bi-instagram',
                'placeholder' => 'https://instagram.com/sua-conta',
            ],
            'whatsapp' => [
                'label' => 'WhatsApp',
                'icon' => 'bi-whatsapp',
                'placeholder' => 'https://wa.me/5511999999999',
            ],
            'tiktok' => [
                'label' => 'TikTok',
                'icon' => 'bi-tiktok',
                'placeholder' => 'https://tiktok.com/@sua-conta',
            ],
        ];
    }

    /**
     * Retorna a instância única de configuração do rodapé (id = 1).
     */
    public static function get(): self
    {
        $setting = static::find(1);
        if (!$setting) {
            $defaults = array_fill_keys(array_keys(static::socialNetworks()), '');
            static::query()->insert([
                'id' => 1,
                'copyright' => '',
                'social_links' => json_encode($defaults),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $setting = static::find(1);
        }
        return $setting;
    }
}
