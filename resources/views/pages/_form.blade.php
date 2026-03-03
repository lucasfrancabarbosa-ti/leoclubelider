@csrf

<div class="mb-3">
    <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title ?? '') }}" required maxlength="255" placeholder="Título da página">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="body" class="form-label">Texto principal (HTML)</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="8" placeholder="Conteúdo em texto ou HTML">{{ old('body', $page->body ?? '') }}</textarea>
    @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="show_carousel" name="show_carousel" value="1" {{ old('show_carousel', $page->show_carousel ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="show_carousel">Exibir carrossel de imagens</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="show_novidades" name="show_novidades" value="1" {{ old('show_novidades', $page->show_novidades ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="show_novidades">Exibir novidades</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="is_home" name="is_home" value="1" {{ old('is_home', $page->is_home ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_home">Página inicial (home)</label>
        </div>
    </div>
</div>

<div class="mb-3" id="featured-image-field">
    <label class="form-label">Imagem de rosto (quando não exibir carrossel)</label>
    <p class="text-muted small mb-2">Exibida no topo da página pública no mesmo local do carrossel, quando a página não usa carrossel.</p>
    @if(isset($page) && $page->featured_image)
        <div class="mb-2">
            <img src="{{ $page->featured_image_url }}" alt="Imagem atual" class="img-thumbnail" style="max-height: 120px;">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_featured_image" id="remove_featured_image" value="1">
                <label class="form-check-label" for="remove_featured_image">Remover imagem</label>
            </div>
        </div>
        <label for="featured_image" class="small">Substituir por nova imagem:</label>
    @endif
    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" accept="image/jpeg,image/png,image/webp,image/gif">
    @error('featured_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($page) && $page->exists ? 'Atualizar' : 'Criar' }}
    </button>
    <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
