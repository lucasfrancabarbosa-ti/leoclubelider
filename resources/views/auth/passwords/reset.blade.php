@extends('layouts.app')

@section('title', 'Redefinir Senha - ' . config('app.name'))

@section('content')
<div class="auth-header">
    <h2><i class="bi bi-shield-lock"></i> Redefinir Senha</h2>
    <p class="text-muted">Digite sua nova senha</p>
</div>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">
            <i class="bi bi-envelope"></i> Email
        </label>
        <input 
            type="email" 
            class="form-control @error('email') is-invalid @enderror" 
            id="email" 
            name="email" 
            value="{{ $email ?? old('email') }}" 
            required 
            autofocus
            readonly
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            <i class="bi bi-lock"></i> Nova Senha
        </label>
        <input 
            type="password" 
            class="form-control @error('password') is-invalid @enderror" 
            id="password" 
            name="password" 
            required
            placeholder="Mínimo 8 caracteres"
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">
            <i class="bi bi-lock-fill"></i> Confirmar Nova Senha
        </label>
        <input 
            type="password" 
            class="form-control" 
            id="password_confirmation" 
            name="password_confirmation" 
            required
            placeholder="Digite a senha novamente"
        >
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-circle"></i> Redefinir Senha
    </button>

    <div class="auth-footer">
        <p class="mb-0">
            <a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Voltar para login</a>
        </p>
    </div>
</form>
@endsection
