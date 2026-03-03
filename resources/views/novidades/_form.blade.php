@csrf

<div class="mb-3">
    <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $novidade->title ?? '') }}" required maxlength="20" placeholder="Máx. 20 caracteres">
    <div class="form-text">Máximo 20 caracteres.</div>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required maxlength="100" placeholder="Máx. 100 caracteres">{{ old('description', $novidade->description ?? '') }}</textarea>
    <div class="form-text">Máximo 100 caracteres.</div>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="published_at" class="form-label">Data e hora <span class="text-danger">*</span></label>
    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', isset($novidade) && $novidade->published_at ? $novidade->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required>
    @error('published_at')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Imagem</label>
    @if(isset($novidade) && $novidade->image)
        <div class="mb-2">
            <img src="{{ $novidade->image_url }}" alt="" class="img-thumbnail" style="max-height: 120px;">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                <label class="form-check-label" for="remove_image">Remover imagem</label>
            </div>
        </div>
        <label for="image" class="small">Substituir por nova imagem:</label>
    @endif
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/gif">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($novidade) && $novidade->exists ? 'Atualizar' : 'Criar' }}
    </button>
    <a href="{{ route('novidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
