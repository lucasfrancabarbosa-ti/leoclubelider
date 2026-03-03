<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\MenuSetting;
use App\Models\Novidade;
use App\Models\Page;

class PublicController extends Controller
{
    /**
     * Página inicial do site (página marcada como home ou primeira do menu).
     */
    public function home()
    {
        $page = Page::home()->first();
        if (!$page) {
            $menuSetting = MenuSetting::get();
            $ordered = $menuSetting->getOrderedPages();
            $page = $ordered->first();
        }
        if ($page) {
            return redirect()->route('page.show', $page);
        }
        return view('public.welcome');
    }

    /**
     * Exibir uma página pública.
     */
    public function showPage(Page $page)
    {
        $carousel = null;
        if ($page->show_carousel) {
            $carousel = Carousel::active()->with('images')->first();
        }
        $novidades = $page->show_novidades
            ? Novidade::orderByDesc('published_at')->limit(3)->get()
            : collect();
        return view('public.page', compact('page', 'carousel', 'novidades'));
    }
}
