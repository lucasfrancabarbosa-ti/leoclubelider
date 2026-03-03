<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar {
            background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand, .navbar .nav-link { color: white !important; }
        .navbar .nav-link:hover { opacity: 0.9; }
        .card { border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .btn-primary { background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%); border: none; }
        .btn-primary:hover { opacity: 0.95; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-shield-check"></i> {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feedback.create') }}"><i class="bi bi-chat-quote"></i> Feedback</a>
                    </li>
                    @if(Auth::user()->canManageContent())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.index') }}"><i class="bi bi-file-text"></i> Páginas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carousels.index') }}"><i class="bi bi-images"></i> Carrosséis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}"><i class="bi bi-calendar-event"></i> Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('novidades.index') }}"><i class="bi bi-newspaper"></i> Novidades</a>
                    </li>
                    @endif
                    @if(Auth::user()->canManageMenu())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu-config.index') }}"><i class="bi bi-list-ul"></i> Menu</a>
                    </li>
                    @endif
                    @if(Auth::user()->canManageFooter())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('footer-config.index') }}"><i class="bi bi-window"></i> Rodapé</a>
                    </li>
                    @endif
                    @if(Auth::user()->canManageUsers())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"><i class="bi bi-people"></i> Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.feedbacks.index') }}"><i class="bi bi-chat-left-quote"></i> Feedbacks</a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
