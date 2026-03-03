@extends('layouts.dashboard')

@section('title', 'Rodapé')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-window"></i> Configuração do rodapé</h2>
</div>

<form action="{{ route('footer-config.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Copyright</h5>
        </div>
        <div class="card-body">
            <label for="copyright" class="form-label">Texto de copyright</label>
            <input type="text" class="form-control @error('copyright') is-invalid @enderror" id="copyright" name="copyright" value="{{ old('copyright', $setting->copyright) }}" placeholder="Ex: © 2024 LeoClube. Todos os direitos reservados." maxlength="500">
            @error('copyright')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Redes sociais</h5>
        </div>
        <div class="card-body">
            <p class="text-muted small">Informe o link completo de cada rede. Deixe em branco para não exibir.</p>
            @php
                $socialLinks = $setting->social_links ?? [];
            @endphp
            @foreach(\App\Models\FooterSetting::socialNetworks() as $key => $config)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <span class="badge bg-light text-dark border p-2 rounded">
                            <i class="bi {{ $config['icon'] }}" style="font-size: 1.25rem;"></i>
                            {{ $config['label'] }}
                        </span>
                    </div>
                    <div class="col">
                        <input type="{{ $key === 'whatsapp' ? 'text' : 'url' }}" class="form-control @error('social_links.'.$key) is-invalid @enderror" name="social_links[{{ $key }}]" value="{{ old('social_links.'.$key, $socialLinks[$key] ?? '') }}" placeholder="{{ $config['placeholder'] }}">
                        @error('social_links.'.$key)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
            <p class="text-muted small mb-0 mt-2">WhatsApp: use <code>https://wa.me/5511999999999</code> (com DDI e DDD, sem + ou espaços).</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar configuração</button>
</form>
@endsection
