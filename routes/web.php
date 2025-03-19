<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AboutPage;
use App\Livewire\CountyDetailPage;
use App\Livewire\CountyListPage;
use App\Livewire\CultureDetailPage;
use App\Livewire\CulturePage;
use App\Livewire\EventDetailPage;
use App\Livewire\EventPage;
use App\Livewire\HomePage;
use App\Livewire\CategoryPage;
use App\Livewire\PlaceDetailPage;
use App\Livewire\PlacePage;
use App\Livewire\TourismDetailPage;
use App\Livewire\TourismPage;
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

    Route::get('/{categorySlug}/{placeSlug}', EventDetailPage::class)->name('news.detail');
});

Route::prefix('ilceler-listesi')->group(function () {

    Route::get('/', CountyListPage::class)->name('counties.listing');

    Route::get('/{placeSlug}', CountyDetailPage::class)->name('counties.detail');
});

Route::prefix('turizm')->group(function () {

    Route::get('/{slug}', TourismPage::class)->name('tourism.listing');

    Route::get('/{categorySlug}/{placeSlug}', TourismDetailPage::class)->name('tourism.detail');
});

Route::get('/category/{slug?}', CategoryPage::class)->name('housing.by.category');



/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/agent.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
