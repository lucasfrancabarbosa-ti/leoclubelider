<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; }
        .navbar-public {
            background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-public .navbar-brand,
        .navbar-public .nav-link {
            color: rgba(255,255,255,0.95) !important;
        }
        .navbar-public .nav-link:hover { color: #fff !important; }
        .navbar-public .nav-link.active { font-weight: 600; color: #fff !important; }
        .navbar-public .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
            color: #fff;
        }
        .navbar-public .navbar-logo {
            max-height: 40px;
            width: auto;
            object-fit: contain;
        }
        @media (min-width: 992px) {
            .navbar-public .nav-pages { flex: 1; justify-content: center; }
            .navbar-public .nav-end { margin-left: auto; }
        }
        .footer-public {
            background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%);
            color: rgba(255,255,255,0.95);
            margin-top: auto;
        }
        .footer-public a { color: rgba(255,255,255,0.95); text-decoration: none; }
        .footer-public a:hover { color: #fff; }
        .footer-public .social-link { font-size: 1.5rem; margin-left: 0.75rem; }
        .footer-public .social-link:first-child { margin-left: 0; }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $menuSetting = \App\Models\MenuSetting::get();
        $menuPages = $menuSetting->getOrderedPages();
        $showDashboardLink = $menuSetting->show_dashboard_link;
    @endphp
    <nav class="navbar navbar-public navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                @if($menuSetting->logo)
                    <img src="{{ asset('storage/' . $menuSetting->logo) }}" alt="{{ config('app.name') }}" class="navbar-logo">
                @else
                    <i class="bi bi-shield-check me-1"></i> {{ config('app.name') }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic" aria-controls="navbarPublic" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPublic">
                <ul class="navbar-nav nav-pages mb-2 mb-lg-0">
                    @foreach($menuPages as $page)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->url() === route('page.show', $page) ? 'active' : '' }}" href="{{ route('page.show', $page) }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if($showDashboardLink)
                    <ul class="navbar-nav nav-end">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Área logada
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @php
        $footerSetting = \App\Models\FooterSetting::get();
        $socialLinks = $footerSetting->social_links ?? [];
        $socialNetworks = \App\Models\FooterSetting::socialNetworks();
    @endphp
    <footer class="footer-public py-4">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center gap-3">
                <div class="order-2 order-md-1 d-none d-md-block flex-grow-1" aria-hidden="true"></div>
                <div class="order-1 order-md-2 text-center">
                    @if(!empty($footerSetting->copyright))
                        <span class="small">{{ $footerSetting->copyright }}</span>
                    @endif
                </div>
                <div class="order-3 flex-grow-1 d-flex align-items-center justify-content-center justify-content-md-end flex-wrap gap-2">
                    @foreach($socialNetworks as $key => $config)
                        @if(!empty($socialLinks[$key] ?? ''))
                            <a href="{{ $socialLinks[$key] }}" target="_blank" rel="noopener noreferrer" class="social-link" title="{{ $config['label'] }}" aria-label="{{ $config['label'] }}">
                                <i class="bi {{ $config['icon'] }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
