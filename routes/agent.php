<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\EventController;
use App\Http\Controllers\Agent\FestivalController;
use App\Http\Controllers\Agent\GovernmentController;
use App\Http\Controllers\Agent\HousingController;
use App\Http\Controllers\Agent\NewsController;
use App\Http\Controllers\Agent\TourismOfficeController;

Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function(){
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');

    // Government Routes
    Route::resource('government', GovernmentController::class)->except(['show', 'destroy']);
    Route::get('government/delete/{id}', [GovernmentController::class, 'delete'])->name('government.destroy');
    Route::post('government/upload', [GovernmentController::class, 'upload'])->name('government.upload');

    // Local Festivals Routes
    Route::resource('local-festivals', FestivalController::class)->except(['show', 'destroy']);
    Route::get('local-festivals/delete/{id}', [FestivalController::class, 'delete'])->name('local-festivals.destroy');
    Route::post('local-festivals/upload', [FestivalController::class, 'upload'])->name('local-festivals.upload');

    // Events Routes
    Route::resource('events', EventController::class)->except(['show', 'destroy']);
    Route::get('events/delete/{id}', [EventController::class, 'delete'])->name('events.destroy');
    Route::post('events/upload', [EventController::class, 'upload'])->name('events.upload');

    // News Routes
    Route::resource('news', NewsController::class)->except(['show', 'destroy']);
    Route::get('news/delete/{id}', [NewsController::class, 'delete'])->name('news.destroy');
    Route::post('news/upload', [NewsController::class, 'upload'])->name('news.upload');

    // Housing Routes
    Route::resource('housing', HousingController::class)->except(['show', 'destroy']);
    Route::get('housing/delete/{id}', [HousingController::class, 'delete'])->name('housing.destroy');
    Route::post('housing/upload', [HousingController::class, 'upload'])->name('housing.upload');
    Route::post('housing/delete-image', [HousingController::class, 'deleteImage'])->name('housing.delete-image');

    // Tourism Offices Routes
    Route::resource('tourism-office', TourismOfficeController::class)->except(['show', 'destroy']);
    Route::get('tourism-office/delete/{id}', [TourismOfficeController::class, 'delete'])->name('tourism-office.destroy');
    Route::post('tourism-office/upload', [TourismOfficeController::class, 'upload'])->name('tourism-office.upload');

});
