<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountyController;
use App\Http\Controllers\Admin\FestivalController;
use App\Http\Controllers\Admin\GovernmentController;
use App\Http\Controllers\Admin\GovernmentTitleController;
use App\Http\Controllers\Admin\HistoryPlaceController;
use App\Http\Controllers\Admin\MuseumPlaceController;
use App\Http\Controllers\Admin\NaturalPlaceController;
use App\Http\Controllers\Admin\VisitPlaceController;
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

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(callback: function(){
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

    // Government Routes
    Route::resource('government', GovernmentController::class)->except(['show', 'destroy']);
    Route::get('governments/delete/{id}', [GovernmentController::class, 'delete'])->name('governments.destroy');
    Route::post('governments/upload', [GovernmentController::class, 'upload'])->name('governments.upload');
    Route::post('governments/changeStatus/{id}/{status}', [GovernmentController::class, 'changeStatus']);

    // History and Geographical Routes
    Route::prefix('about')->name('about.')->group(function(){
        Route::get('/history', [AboutController::class, 'history'])->name('history');
        Route::post('/history/update', [AboutController::class, 'historyUpdate'])->name('history-update');
        Route::get('/geographical', [AboutController::class, 'geographical'])->name('geographical');
        Route::post('geographical/update', [AboutController::class, 'geographicalUpdate'])->name('geographical-update');
        Route::post('/about/upload', [AboutController::class, 'upload'])->name('upload');
    });

    // Visit Places Routes
    Route::resource('history-places', HistoryPlaceController::class)->except(['show', 'destroy']);
    Route::get('history-places/delete/{id}', [HistoryPlaceController::class, 'delete'])->name('history-places.destroy');
    Route::post('history-places/upload', [HistoryPlaceController::class, 'upload'])->name('history-places.upload');
    Route::post('history-places/changeStatus/{id}/{status}', [HistoryPlaceController::class, 'changeStatus']);

    // Natural Place Routes
    Route::resource('natural-places', NaturalPlaceController::class)->except(['show', 'destroy']);
    Route::get('natural-places/delete/{id}', [NaturalPlaceController::class, 'delete'])->name('natural-places.destroy');
    Route::post('natural-places/upload', [NaturalPlaceController::class, 'upload'])->name('natural-places.upload');
    Route::post('natural-places/changeStatus/{id}/{status}', [NaturalPlaceController::class, 'changeStatus']);

    // Museums and Art Galleries Routes
    Route::resource('museum-places', MuseumPlaceController::class)->except(['show', 'destroy']);
    Route::get('museum-places/delete/{id}', [MuseumPlaceController::class, 'delete'])->name('museum-places.destroy');
    Route::post('museum-places/upload', [MuseumPlaceController::class, 'upload'])->name('museum-places.upload');
    Route::post('museum-places/changeStatus/{id}/{status}', [MuseumPlaceController::class, 'changeStatus']);

    // Local Festivals Routes
    Route::resource('local-festivals', FestivalController::class)->except(['show', 'destroy']);
    Route::get('local-festivals/delete/{id}', [FestivalController::class, 'delete'])->name('local-festivals.destroy');
    Route::post('local-festivals/upload', [FestivalController::class, 'upload'])->name('local-festivals.upload');
    Route::post('local-festivals/changeStatus/{id}/{status}', [FestivalController::class, 'changeStatus']);
});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});

require __DIR__.'/auth.php';
