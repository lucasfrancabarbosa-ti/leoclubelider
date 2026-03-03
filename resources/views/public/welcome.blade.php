@extends('layouts.public')

@section('title', config('app.name'))

@section('content')
<div class="container py-5">
    <div class="text-center py-5">
        <h1>{{ config('app.name') }}</h1>
        <p class="lead text-muted">Bem-vindo ao nosso site.</p>
        <p class="text-muted">Nenhuma página configurada ainda. Acesse a área logada para criar páginas e configurar o menu.</p>
    </div>
</div>
@endsection
