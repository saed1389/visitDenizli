<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AboutPage;
use App\Livewire\CultureDetailPage;
use App\Livewire\CulturePage;
use App\Livewire\EventPage;
use App\Livewire\HomePage;
use App\Livewire\PlaceDetailPage;
use App\Livewire\PlacePage;
use Illuminate\Support\Facades\Route;

Route::get('/change-locale/{locale}', function ($locale) {
    if (in_array($locale, ['tr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

Route::get('/', HomePage::class);

Route::get('/hakkimiza/{slug}', AboutPage::class);

Route::prefix('gezilecek-yerler')->group(function () {

    Route::get('/{slug}', PlacePage::class)->name('place.listing');

    Route::get('/{categorySlug}/{placeSlug}', PlaceDetailPage::class)->name('place.detail');
});

Route::prefix('kultur-ve-sanat')->group(function () {

    Route::get('/{slug}', CulturePage::class)->name('culture.listing');

    Route::get('/{categorySlug}/{placeSlug}', CultureDetailPage::class)->name('culture.detail');
});

Route::prefix('etkinlikler-ve-haberler')->group(function () {

    Route::get('/{slug}', EventPage::class)->name('news.listing');

    Route::get('/{categorySlug}/{placeSlug}', EventPage::class)->name('news.detail');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/agent.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
