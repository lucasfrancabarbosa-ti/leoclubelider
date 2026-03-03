@extends('layouts.dashboard')

@section('title', 'Carrosséis')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-images"></i> Carrosséis</h2>
    <a href="{{ route('carousels.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo carrossel
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Imagens</th>
                        <th class="text-center">Ativo</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carousels as $carousel)
                        <tr>
                            <td>{{ $carousel->name ?: '—' }}</td>
                            <td class="text-center">{{ $carousel->images_count }}</td>
                            <td class="text-center">
                                @if($carousel->is_active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('carousels.edit', $carousel) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('carousels.destroy', $carousel) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este carrossel e todas as imagens?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhum carrossel. <a href="{{ route('carousels.create') }}">Criar primeiro carrossel</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($carousels->hasPages())
        <div class="card-footer">{{ $carousels->links() }}</div>
    @endif
</div>
@endsection
