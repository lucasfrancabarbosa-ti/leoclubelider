@extends('layouts.app')

@section('title', 'Recuperar Senha - ' . config('app.name'))

@section('content')
<div class="auth-header">
    <h2><i class="bi bi-key"></i> Recuperar Senha</h2>
    <p class="text-muted">Digite seu email para receber o link de recuperação</p>
</div>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">
            <i class="bi bi-envelope"></i> Email
        </label>
        <input 
            type="email" 
            class="form-control @error('email') is-invalid @enderror" 
            id="email" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autofocus
            placeholder="seu@email.com"
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-send"></i> Enviar Link de Recuperação
    </button>

    <div class="auth-footer">
        <p class="mb-0">
            <a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Voltar para login</a>
        </p>
    </div>
</form>
@endsection
