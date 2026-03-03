@extends('layouts.dashboard')

@section('title', 'Novo evento')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-calendar-plus"></i> Novo evento</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('events.store') }}" method="POST">
            @include('events._form', ['event' => new \App\Models\Event()])
        </form>
    </div>
</div>
@endsection
