@extends('layouts.app')

@section('title', 'Registro - ' . config('app.name'))

@section('content')
<div class="auth-header">
    <h2><i class="bi bi-person-plus"></i> Criar Conta</h2>
    <p class="text-muted">Preencha os dados para criar sua conta</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">
            <i class="bi bi-person"></i> Nome
        </label>
        <input 
            type="text" 
            class="form-control @error('name') is-invalid @enderror" 
            id="name" 
            name="name" 
            value="{{ old('name') }}" 
            required 
            autofocus
            placeholder="Seu nome completo"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

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
            placeholder="Mínimo 8 caracteres"
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">
            <i class="bi bi-lock-fill"></i> Confirmar Senha
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
        <i class="bi bi-person-plus"></i> Criar Conta
    </button>

    <div class="auth-footer">
        <p class="mb-0">
            Já tem uma conta? <a href="{{ route('login') }}">Faça login</a>
        </p>
    </div>
</form>
@endsection
