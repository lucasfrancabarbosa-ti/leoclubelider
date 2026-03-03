@extends('layouts.dashboard')

@section('title', 'Feedback')

@section('content')
<div class="card">
    <div class="card-header" style="background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%); color: #fff;">
        <h5 class="mb-0"><i class="bi bi-chat-quote"></i> Enviar feedback (anônimo)</h5>
    </div>
    <div class="card-body">
        <p class="text-muted small">Seu feedback é anônimo e não será associado ao seu usuário.</p>
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" maxlength="255" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" maxlength="5000" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Enviar</button>
        </form>
    </div>
</div>
@endsection
