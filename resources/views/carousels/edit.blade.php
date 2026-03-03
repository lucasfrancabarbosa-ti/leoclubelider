@extends('layouts.dashboard')

@section('title', 'Editar carrossel')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('carousels.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-images"></i> {{ $carousel->name ?: 'Carrossel' }}</h2>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Dados do carrossel</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('carousels.update', $carousel) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <label for="name" class="form-label">Nome (opcional)</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $carousel->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $carousel->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Carrossel ativo</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0">Imagens (ordem de exibição)</h5>
        <form action="{{ route('carousels.images.store', $carousel) }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
            @csrf
            <input type="file" name="image" accept="image/*" required class="form-control form-control-sm" style="max-width: 220px;">
            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-upload"></i> Enviar</button>
        </form>
    </div>
    <div class="card-body">
        @if($carousel->images->isEmpty())
            <p class="text-muted mb-0">Nenhuma imagem. Use o formulário acima para fazer upload.</p>
        @else
            <form action="{{ route('carousels.images.reorder', $carousel) }}" method="POST" id="reorder-form">
                @csrf
                <div class="row g-3 mb-3" id="sortable-images">
                    @foreach($carousel->images as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3" data-id="{{ $image->id }}">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="" class="card-img-top" style="height: 140px; object-fit: cover;">
                                <div class="card-body py-2 px-2 d-flex justify-content-between align-items-center">
                                    <span class="text-muted small">Ordem: {{ $image->order + 1 }}</span>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-secondary btn-move" data-dir="up" title="Subir"><i class="bi bi-arrow-up"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-move" data-dir="down" title="Descer"><i class="bi bi-arrow-down"></i></button>
                                        <form action="{{ route('carousels.images.destroy', [$carousel, $image]) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover esta imagem?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Excluir"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="order-inputs"></div>
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-right"></i> Salvar ordem</button>
            </form>
        @endif
    </div>
</div>

@push('scripts')
<script>
(function() {
    const form = document.getElementById('reorder-form');
    if (!form) return;
    const container = document.getElementById('sortable-images');
    const orderInputs = document.getElementById('order-inputs');

    function updateOrder() {
        const ids = Array.from(container.querySelectorAll('[data-id]')).map(el => el.getAttribute('data-id'));
        orderInputs.innerHTML = ids.map(id => '<input type="hidden" name="order[]" value="' + id + '">').join('');
    }

    container.querySelectorAll('.btn-move').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('[data-id]');
            const dir = this.dataset.dir;
            const prev = dir === 'up' ? card.previousElementSibling : card.nextElementSibling;
            if (prev && prev.matches('[data-id]')) {
                if (dir === 'up') container.insertBefore(card, prev);
                else container.insertBefore(prev, card);
                updateOrder();
            }
        });
    });

    updateOrder();
})();
</script>
@endpush
@endsection
