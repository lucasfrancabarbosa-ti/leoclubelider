@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name ?? '') }}" required maxlength="255" placeholder="Nome do evento">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="date_time" class="form-label">Data e hora (Horário de Brasília) <span class="text-danger">*</span></label>
    <input type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" id="date_time" name="date_time" value="{{ old('date_time', isset($event) && $event->date_time ? $event->date_time->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i') : '') }}" required>
    @error('date_time')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="location" class="form-label">Localização (endereço) <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $event->location ?? '') }}" required maxlength="500" placeholder="Endereço completo">
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($event) && $event->exists ? 'Atualizar' : 'Criar' }}
    </button>
    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
