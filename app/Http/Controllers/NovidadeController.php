<?php

namespace App\Http\Controllers;

use App\Models\Novidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NovidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $novidades = Novidade::orderByDesc('published_at')->paginate(15);
        return view('novidades.index', compact('novidades'));
    }

    public function create()
    {
        return view('novidades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['required', 'date'],
        ]);

        $validated['published_at'] = $request->date('published_at');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('novidades', 'public');
        } else {
            $validated['image'] = null;
        }

        Novidade::create($validated);

        return redirect()->route('novidades.index')->with('success', 'Novidade criada com sucesso.');
    }

    public function edit(Novidade $novidade)
    {
        return view('novidades.edit', compact('novidade'));
    }

    public function update(Request $request, Novidade $novidade)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['required', 'date'],
        ]);

        $validated['published_at'] = $request->date('published_at');

        if ($request->boolean('remove_image')) {
            if ($novidade->image && Storage::disk('public')->exists($novidade->image)) {
                Storage::disk('public')->delete($novidade->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($novidade->image && Storage::disk('public')->exists($novidade->image)) {
                Storage::disk('public')->delete($novidade->image);
            }
            $validated['image'] = $request->file('image')->store('novidades', 'public');
        } else {
            $validated['image'] = $novidade->image;
        }

        $novidade->update($validated);

        return redirect()->route('novidades.index')->with('success', 'Novidade atualizada com sucesso.');
    }

    public function destroy(Novidade $novidade)
    {
        $novidade->delete();
        return redirect()->route('novidades.index')->with('success', 'Novidade removida com sucesso.');
    }
}
