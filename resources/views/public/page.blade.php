@extends('layouts.public')

@section('title', $page->title . ' - ' . config('app.name'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($carousel && $carousel->images->isNotEmpty())
            <div class="mb-4 ratio ratio-16x9 overflow-hidden bg-dark rounded">
                <div id="pageCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        @foreach($carousel->images as $index => $image)
                            <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 h-100" alt="" style="object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @if($carousel->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#pageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#pageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            </div>
            @elseif($page->featured_image)
            <div class="mb-4 ratio ratio-16x9 overflow-hidden bg-dark rounded">
                <img src="{{ $page->featured_image_url }}" alt="" class="d-block w-100 h-100" style="object-fit: cover;">
            </div>
            @endif

            <h1 class="mb-4">{{ $page->title }}</h1>
            <div class="content">
                {!! $page->body !!}
            </div>

            @if($novidades->isNotEmpty())
            <section class="mt-5 pt-4 border-top">
                <h2 class="h5 mb-3">Últimas novidades</h2>
                <div class="row g-3">
                    @foreach($novidades as $novidade)
                    <div class="col-md-4">
                        <div class="card h-100 flex-row overflow-hidden">
                            <div class="flex-shrink-0" style="width: 120px;">
                                @if($novidade->image)
                                    <img src="{{ $novidade->image_url }}" class="w-100 h-100" style="object-fit: cover;" alt="">
                                @else
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column flex-grow-1 p-3">
                                <h3 class="card-title h6 mb-2">{{ $novidade->title }}</h3>
                                <p class="card-text small text-muted mb-0 flex-grow-1">{{ $novidade->description }}</p>
                                <small class="text-muted">{{ $novidade->published_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </div>
</div>
@endsection
