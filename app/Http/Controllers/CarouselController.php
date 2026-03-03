<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carousels = Carousel::withCount('images')->orderBy('is_active', 'desc')->orderBy('name')->paginate(15);
        return view('carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('carousels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        if ($validated['is_active']) {
            Carousel::where('is_active', true)->update(['is_active' => false]);
        }

        $carousel = Carousel::create($validated);
        return redirect()->route('carousels.edit', $carousel)->with('success', 'Carrossel criado. Adicione as imagens.');
    }

    public function edit(Carousel $carousel)
    {
        $carousel->load('images');
        return view('carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        if ($validated['is_active']) {
            Carousel::where('is_active', true)->where('id', '!=', $carousel->id)->update(['is_active' => false]);
        }

        $carousel->update($validated);
        return redirect()->route('carousels.edit', $carousel)->with('success', 'Carrossel atualizado.');
    }

    public function destroy(Carousel $carousel)
    {
        foreach ($carousel->images as $img) {
            Storage::disk('public')->delete($img->path);
        }
        $carousel->delete();
        return redirect()->route('carousels.index')->with('success', 'Carrossel removido.');
    }

    public function storeImage(Request $request, Carousel $carousel)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120'], // 5MB
        ]);

        $file = $request->file('image');
        $path = $file->store("carousels/{$carousel->id}", 'public');

        $maxOrder = $carousel->images()->max('order') ?? 0;
        $carousel->images()->create([
            'path' => $path,
            'order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Imagem adicionada.');
    }

    public function reorderImages(Request $request, Carousel $carousel)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:carousel_images,id'],
        ]);

        foreach ($request->order as $position => $id) {
            CarouselImage::where('id', $id)->where('carousel_id', $carousel->id)->update(['order' => $position]);
        }

        return back()->with('success', 'Ordem atualizada.');
    }

    public function destroyImage(Carousel $carousel, CarouselImage $image)
    {
        if ($image->carousel_id !== $carousel->id) {
            abort(404);
        }
        $image->delete();
        return back()->with('success', 'Imagem removida.');
    }
}
