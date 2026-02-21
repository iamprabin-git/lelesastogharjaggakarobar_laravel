<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\PaymentController;

// Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// Agent registration
Route::get('/agent-form', [PageController::class, 'agent_form'])->name('agent_form');
Route::post('/agent-store', [PageController::class, 'agent_store'])->name('agent_store');
Route::post('/agent/{agent}/contact', [PageController::class, 'contactAgent'])->name('agent.contact');

// Properties
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Protect Edit & Update
Route::middleware('auth')->group(function () {
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])
        ->name('properties.edit');

    Route::put('/properties/{property}', [PropertyController::class, 'update'])
        ->name('properties.update');

    Route::delete('/properties/{property}/image/{index}', [PropertyController::class, 'deleteImage'])
        ->name('properties.image.delete');

    Route::post('/payment/store', [PaymentController::class, 'store'])
        ->name('payment.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

// Static Pages
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');

Route::view('/privacy-policy', 'frontend.privacy_policy')->name('privacy.policy');
Route::view('/terms', 'frontend.terms')->name('terms');

// Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// Pricing
Route::view('/pricing', 'frontend.pricing')->name('pricing');

// QR Page
Route::view('/qr', 'frontend.qr')->name('qr');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
