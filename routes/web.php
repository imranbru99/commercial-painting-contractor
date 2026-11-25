<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/services/{slug}', [SiteController::class, 'serviceShow'])->name('services.show');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'contactStore'])->name('contact.store');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [SiteController::class, 'blogShow'])->name('blog.show');
Route::get('/knowledge', [SiteController::class, 'knowledge'])->name('knowledge');
Route::get('/knowledge/{slug}', [SiteController::class, 'knowledgeShow'])->name('knowledge.show');
Route::post('/api/chat', [SiteController::class, 'chat'])->name('chat');
