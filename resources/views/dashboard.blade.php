@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="welcome-header rounded-3 text-white p-4 mb-4" style="background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%);">
    <h1><i class="bi bi-check-circle"></i> Bem-vindo, {{ Auth::user()->name }}!</h1>
    <p class="mb-0">Você está autenticado no sistema.</p>
</div>

<div class="row">
    <div class="col-12 col-lg-9 order-1 order-lg-2 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%); color: #fff;">
                <a href="{{ route('dashboard', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" class="btn btn-light btn-sm"><i class="bi bi-chevron-left"></i></a>
                <h5 class="mb-0 text-center">{{ $current->locale('pt_BR')->translatedFormat('F Y') }}</h5>
                <a href="{{ route('dashboard', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" class="btn btn-light btn-sm"><i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 dashboard-calendar">
                    <thead>
                        <tr class="table-light">
                            <th class="text-center py-2">Dom</th>
                            <th class="text-center py-2">Seg</th>
                            <th class="text-center py-2">Ter</th>
                            <th class="text-center py-2">Qua</th>
                            <th class="text-center py-2">Qui</th>
                            <th class="text-center py-2">Sex</th>
                            <th class="text-center py-2">Sáb</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weeks as $week)
                        <tr>
                            @foreach($week as $cell)
                            <td class="p-1 align-top calendar-day @if($cell['day'] === null) bg-light @endif" style="min-height: 100px; vertical-align: top;">
                                @if($cell['day'] !== null)
                                    <div class="fw-semibold text-muted small">{{ $cell['day'] }}</div>
                                    @foreach($cell['events'] as $event)
                                    <div class="small border-start border-3 border-primary ps-2 mb-1 py-1" style="border-color: #5293CD !important;">
                                        <div class="fw-semibold">{{ $event->name }}</div>
                                        <div class="text-muted">{{ $event->date_time->setTimezone('America/Sao_Paulo')->format('H:i') }} · {{ Str::limit($event->location, 25) }}</div>
                                    </div>
                                    @endforeach
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer small text-muted">
                <i class="bi bi-clock"></i> Horários em Brasília
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 mt-3 p-3 rounded-3 bg-light border">
            <p class="mb-0 text-muted text-center text-sm-start">Tem algo pra compartilhar? Sua voz é anônima e faz a diferença.</p>
            <a href="{{ route('feedback.create') }}" class="btn btn-primary btn-sm flex-shrink-0"><i class="bi bi-chat-quote"></i> Pode falar!</a>
        </div>
    </div>
    <aside class="col-12 col-lg-3 order-2 order-lg-1">
        <div class="card text-center p-4 mb-3">
            <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #5293CD;"></i>
            <h5 class="mt-3">Perfil</h5>
            <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
            @php $roles = \App\Models\User::roles(); @endphp
            <p class="small mb-0 mt-1"><span class="badge bg-secondary">{{ $roles[Auth::user()->role] ?? Auth::user()->role }}</span></p>
        </div>
        @if(Auth::user()->canManageContent())
        <div class="card p-3">
            <h6 class="mb-2"><i class="bi bi-link-45deg"></i> Atalhos</h6>
            <ul class="list-unstyled mb-0 small">
                <li class="mb-1"><a href="{{ route('pages.index') }}">Páginas</a></li>
                <li class="mb-1"><a href="{{ route('carousels.index') }}">Carrosséis</a></li>
                <li class="mb-1"><a href="{{ route('events.index') }}">Eventos</a></li>
                <li><a href="{{ route('novidades.index') }}">Novidades</a></li>
            </ul>
        </div>
        @endif
    </aside>
</div>
@endsection
