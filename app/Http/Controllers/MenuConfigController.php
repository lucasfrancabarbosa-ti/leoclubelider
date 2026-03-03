<?php

namespace App\Http\Controllers;

use App\Models\MenuSetting;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = MenuSetting::get();
        $pageOrder = $setting->page_order ?? [];
        $pagesInMenu = $pageOrder
            ? Page::whereIn('id', $pageOrder)->get()->sortBy(fn ($p) => array_search($p->id, $pageOrder))
            : collect();
        $pagesInMenu = $pagesInMenu->values(); // reindex
        $allPages = Page::orderBy('title')->get();
        $availablePages = $allPages->whereNotIn('id', $pageOrder)->values();

        return view('menu-config.index', [
            'setting' => $setting,
            'pagesInMenu' => $pagesInMenu,
            'availablePages' => $availablePages,
            'pageOrder' => $pageOrder,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'page_order' => ['nullable', 'array'],
            'page_order.*' => ['integer', 'exists:pages,id'],
            'show_dashboard_link' => ['boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        $setting = MenuSetting::get();
        $data = [
            'page_order' => $request->input('page_order', []),
            'show_dashboard_link' => $request->boolean('show_dashboard_link'),
        ];

        if ($request->boolean('remove_logo') && $setting->logo) {
            Storage::disk('public')->delete($setting->logo);
            $data['logo'] = null;
        } elseif ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('menu', 'public');
        }

        $setting->update($data);

        return redirect()->route('menu-config.index')->with('success', 'Configuração do menu salva.');
    }
}
