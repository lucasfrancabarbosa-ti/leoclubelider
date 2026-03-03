@extends('layouts.dashboard')

@section('title', 'Editar evento')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-calendar-event"></i> Editar evento</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('events.update', $event) }}" method="POST">
            @method('PUT')
            @include('events._form', ['event' => $event])
        </form>
    </div>
</div>
@endsection
