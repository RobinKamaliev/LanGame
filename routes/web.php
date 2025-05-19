<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/news', [AdminController::class, 'news'])->name('admin.news');
Route::get('/admin/news/{id}', [AdminController::class, 'show'])->name('admin.news.show');

Route::middleware('auth')->group(static function (): void {
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('/news/parser', [NewsController::class, 'parser'])->name('news.parser');
});

Route::get('/login', fn () => 'Please login')->name('login'); //todo: заглушка
