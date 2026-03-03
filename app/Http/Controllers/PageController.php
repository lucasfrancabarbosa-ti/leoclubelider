<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listar todas as páginas.
     */
    public function index()
    {
        $pages = Page::orderBy('is_home', 'desc')->orderBy('title')->paginate(15);
        return view('pages.index', compact('pages'));
    }

    /**
     * Exibir formulário de criação.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Salvar nova página.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'show_carousel' => ['boolean'],
            'show_novidades' => ['boolean'],
            'is_home' => ['boolean'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['show_carousel'] = $request->boolean('show_carousel');
        $validated['show_novidades'] = $request->boolean('show_novidades');
        $validated['is_home'] = $request->boolean('is_home');
        unset($validated['featured_image']);

        if ($validated['is_home']) {
            Page::where('is_home', true)->update(['is_home' => false]);
        }

        $page = Page::create($validated);

        if (!$validated['show_carousel'] && $request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('pages/' . $page->id, 'public');
            $page->update(['featured_image' => $path]);
        }

        return redirect()->route('pages.index')->with('success', 'Página criada com sucesso.');
    }

    /**
     * Exibir formulário de edição.
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Atualizar página.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'show_carousel' => ['boolean'],
            'show_novidades' => ['boolean'],
            'is_home' => ['boolean'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['show_carousel'] = $request->boolean('show_carousel');
        $validated['show_novidades'] = $request->boolean('show_novidades');
        $validated['is_home'] = $request->boolean('is_home');
        unset($validated['featured_image']);

        if ($validated['is_home']) {
            Page::where('is_home', true)->where('id', '!=', $page->id)->update(['is_home' => false]);
        }

        if ($request->boolean('remove_featured_image') || $request->hasFile('featured_image')) {
            if ($page->featured_image && Storage::disk('public')->exists($page->featured_image)) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = null;
        }

        if (!$validated['show_carousel'] && $request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('pages/' . $page->id, 'public');
            $validated['featured_image'] = $path;
        }

        $page->update($validated);

        return redirect()->route('pages.index')->with('success', 'Página atualizada com sucesso.');
    }

    /**
     * Remover página.
     */
    public function destroy(Page $page)
    {
        if ($page->featured_image && Storage::disk('public')->exists($page->featured_image)) {
            Storage::disk('public')->delete($page->featured_image);
        }
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Página removida com sucesso.');
    }
}
