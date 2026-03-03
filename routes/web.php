<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\MenuConfigController;
use App\Http\Controllers\FooterConfigController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\NovidadeController;

// Rotas públicas do site
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/pagina/{page}', [PublicController::class, 'showPage'])->name('page.show');

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Feedback anônimo: todos os usuários
    Route::get('feedback', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Páginas, Carrosséis, Eventos e Novidades: Administrador e Gestor
    Route::middleware('role:administrador_ou_gestor')->group(function () {
        Route::resource('pages', PageController::class);
        Route::resource('carousels', CarouselController::class);
        Route::post('carousels/{carousel}/images', [CarouselController::class, 'storeImage'])->name('carousels.images.store');
        Route::post('carousels/{carousel}/images/reorder', [CarouselController::class, 'reorderImages'])->name('carousels.images.reorder');
        Route::delete('carousels/{carousel}/images/{image}', [CarouselController::class, 'destroyImage'])->name('carousels.images.destroy');
        Route::resource('events', EventController::class);
        Route::resource('novidades', NovidadeController::class);
    });

    // Menu, Rodapé, Usuários e Feedbacks: apenas Administrador
    Route::middleware('role:administrador')->group(function () {
        Route::get('menu-config', [MenuConfigController::class, 'index'])->name('menu-config.index');
        Route::put('menu-config', [MenuConfigController::class, 'update'])->name('menu-config.update');
        Route::get('footer-config', [FooterConfigController::class, 'index'])->name('footer-config.index');
        Route::put('footer-config', [FooterConfigController::class, 'update'])->name('footer-config.update');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('feedbacks', [AdminFeedbackController::class, 'index'])->name('admin.feedbacks.index');
        Route::post('feedbacks/{feedback}/rate', [AdminFeedbackController::class, 'rate'])->name('admin.feedbacks.rate');
    });
});
