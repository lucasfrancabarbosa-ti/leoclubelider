@extends('layouts.dashboard')

@section('title', 'Páginas')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-file-text"></i> Páginas</h2>
    <a href="{{ route('pages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nova página
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th class="text-center">Carrossel</th>
                        <th class="text-center">Home</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td class="text-center">
                                @if($page->show_carousel)
                                    <span class="badge bg-success">Sim</span>
                                @else
                                    <span class="badge bg-secondary">Não</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($page->is_home)
                                    <span class="badge bg-primary">Home</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover esta página?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhuma página cadastrada. <a href="{{ route('pages.create') }}">Criar primeira página</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pages->hasPages())
        <div class="card-footer">
            {{ $pages->links() }}
        </div>
    @endif
</div>
@endsection
