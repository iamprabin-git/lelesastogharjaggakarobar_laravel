<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');

// Properties (public)
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Static pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
Route::view('/privacy-policy', 'frontend.privacy_policy')->name('privacy.policy');
Route::view('/terms', 'frontend.terms')->name('terms');
Route::view('/pricing', 'frontend.pricing')->name('pricing');
Route::view('/qr', 'frontend.qr')->name('qr');

// Blogs (public)
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// Agent public registration
// Agent Authentication Routes
Route::get('/agent-form', [PageController::class, 'agent_form'])->name('agent.form');
Route::post('/agent-store', [PageController::class, 'agent_store'])->name('agent.store');

// Google OAuth
Route::get('/google/login', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Property management (only owners/admins)
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])
        ->name('properties.edit');

    Route::put('/properties/{property}', [PropertyController::class, 'update'])
        ->name('properties.update');

    Route::delete('/properties/{property}/image/{index}', [PropertyController::class, 'deleteImage'])
        ->name('properties.image.delete');

    // Payment
    Route::post('/payment/store', [PaymentController::class, 'store'])
        ->name('payment.store');

    // Agent contact (from property page)
    Route::post('/agent/{agent}/contact', [PageController::class, 'contactAgent'])
        ->name('agent.contact');
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Add more admin routes here...
});

// Include Breeze/Jetstream auth routes (login, register, etc.)
require __DIR__.'/auth.php';
