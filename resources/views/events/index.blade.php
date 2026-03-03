@extends('layouts.dashboard')

@section('title', 'Eventos')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-calendar-event"></i> Eventos</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo evento
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Data e hora</th>
                        <th>Localização</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->date_time->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</td>
                            <td>{{ Str::limit($event->location, 40) }}</td>
                            <td class="text-end">
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover este evento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhum evento. <a href="{{ route('events.create') }}">Criar primeiro evento</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($events->hasPages())
        <div class="card-footer">{{ $events->links() }}</div>
    @endif
</div>
@endsection
