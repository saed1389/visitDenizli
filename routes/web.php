<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountyController;
use App\Http\Controllers\Admin\GovernmentTitleController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // County Routes
    Route::prefix('counties')->name('counties.')->group(function(){
        Route::get('/', [CountyController::class, 'index'])->name('index');
        Route::post('/store', [CountyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CountyController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CountyController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CountyController::class, 'delete'])->name('destroy');
        Route::post('/upload', [CountyController::class, 'upload'])->name('ckeditor.upload');
    });

    // Categories Routes
    Route::resource('categories', CategoryController::class)->except(['show', 'destroy', 'create']);
    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.destroy');

    // Government Title Routes
    Route::resource('governmentTitles', GovernmentTitleController::class)->except(['show', 'destroy', 'create']);
    Route::get('governmentTitles/delete/{id}', [GovernmentTitleController::class, 'delete'])->name('governmentTitles.destroy');

});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});

require __DIR__.'/auth.php';
