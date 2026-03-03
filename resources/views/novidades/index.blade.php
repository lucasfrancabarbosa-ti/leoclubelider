@extends('layouts.dashboard')

@section('title', 'Últimas novidades')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-newspaper"></i> Últimas novidades</h2>
    <a href="{{ route('novidades.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nova novidade
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Data e hora</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($novidades as $novidade)
                        <tr>
                            <td>
                                @if($novidade->image)
                                    <img src="{{ $novidade->image_url }}" alt="" class="rounded" style="height: 36px; width: 48px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>{{ $novidade->title }}</td>
                            <td>{{ Str::limit($novidade->description, 50) }}</td>
                            <td>{{ $novidade->published_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('novidades.edit', $novidade) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('novidades.destroy', $novidade) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover esta novidade?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhuma novidade. <a href="{{ route('novidades.create') }}">Criar primeira novidade</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($novidades->hasPages())
        <div class="card-footer">{{ $novidades->links() }}</div>
    @endif
</div>
@endsection
