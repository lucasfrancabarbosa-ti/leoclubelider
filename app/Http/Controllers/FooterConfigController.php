<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = FooterSetting::get();
        return view('footer-config.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'copyright' => ['nullable', 'string', 'max:500'],
            'social_links' => ['nullable', 'array'],
            'social_links.facebook' => ['nullable', 'string', 'max:500'],
            'social_links.instagram' => ['nullable', 'string', 'max:500'],
            'social_links.whatsapp' => ['nullable', 'string', 'max:500'],
            'social_links.tiktok' => ['nullable', 'string', 'max:500'],
        ]);

        // WhatsApp pode ser link ou número
        $links = $request->input('social_links', []);
        if (!empty($links['whatsapp']) && !str_starts_with($links['whatsapp'], 'http')) {
            $links['whatsapp'] = 'https://wa.me/' . preg_replace('/\D/', '', $links['whatsapp']);
        }

        $setting = FooterSetting::get();
        $setting->update([
            'copyright' => $validated['copyright'] ?? '',
            'social_links' => array_merge($setting->social_links ?? [], $links),
        ]);

        return redirect()->route('footer-config.index')->with('success', 'Configuração do rodapé salva.');
    }
}
