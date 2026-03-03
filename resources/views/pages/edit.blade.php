@extends('layouts.dashboard')

@section('title', 'Editar página')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-pencil"></i> Editar página</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('pages._form', ['page' => $page])
        </form>
    </div>
</div>
@endsection
