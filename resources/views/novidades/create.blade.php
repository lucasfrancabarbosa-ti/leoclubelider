@extends('layouts.dashboard')

@section('title', 'Nova novidade')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('novidades.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-plus-lg"></i> Nova novidade</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('novidades.store') }}" method="POST" enctype="multipart/form-data">
            @include('novidades._form', ['novidade' => new \App\Models\Novidade()])
        </form>
    </div>
</div>
@endsection
