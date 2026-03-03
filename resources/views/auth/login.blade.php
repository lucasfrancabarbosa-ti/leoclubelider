@extends('layouts.app')

@section('title', 'Login - ' . config('app.name'))

@section('content')
<div class="auth-header">
    <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>
    <p class="text-muted">Entre com suas credenciais</p>
</div>

<form method="POST" action="{{ route('login') }}">
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

    <div class="mb-3">
        <label for="password" class="form-label">
            <i class="bi bi-lock"></i> Senha
        </label>
        <input 
            type="password" 
            class="form-control @error('password') is-invalid @enderror" 
            id="password" 
            name="password" 
            required
            placeholder="••••••••"
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input 
            type="checkbox" 
            class="form-check-input" 
            id="remember" 
            name="remember"
        >
        <label class="form-check-label" for="remember">
            Lembrar-me
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-box-arrow-in-right"></i> Entrar
    </button>

    <div class="auth-footer">
        <p class="mb-2">
            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
        </p>
        <p class="mb-0">
            Não tem uma conta? <a href="{{ route('register') }}">Registre-se</a>
        </p>
    </div>
</form>
@endsection
