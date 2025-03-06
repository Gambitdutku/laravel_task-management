<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Ana sayfa görevler listesine yönlendiriyor
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Görev yönetim sistemi rotaları (CRUD)
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Varsayılan dashboard sayfasını görevler listesine yönlendiriyoruz
Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Laravel Breeze auth rotaları
require __DIR__.'/auth.php';
