<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AboutPage;
use App\Livewire\BlogDetailPage;
use App\Livewire\BlogPage;
use App\Livewire\ContactPage;
use App\Livewire\CountyDetailPage;
use App\Livewire\CountyListPage;
use App\Livewire\CultureDetailPage;
use App\Livewire\CulturePage;
use App\Livewire\EconomyDetailPage;
use App\Livewire\EconomyPage;
use App\Livewire\EventDetailPage;
use App\Livewire\EventPage;
use App\Livewire\GalleryPage;
use App\Livewire\HomePage;
use App\Livewire\CategoryPage;
use App\Livewire\MapPage;
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

Route::prefix('ekonomi')->group(function () {
    Route::get('/{slug}', EconomyPage::class)->name('economy.listing');
    Route::get('/{categorySlug}/{placeSlug}', EconomyDetailPage::class)->name('economy.detail');
});

Route::prefix('galeri')->group(function () {
    Route::get('/{slug}', GalleryPage::class)->name('gallery.listing');
});

Route::prefix('harita')->group(function () {
    Route::get('/{slug}', MapPage::class)->name('map.listing');
});

Route::get('/blog', BlogPage::class)->name('blog.listing');

Route::get('blog/{slug}', BlogDetailPage::class)->name('blog.detail');

Route::get('iletisim', ContactPage::class)->name('contact.page');

Route::get('/kategori/{slug?}', CategoryPage::class)->name('housing.by.category');

Route::get('/search', function () {
    return view('search-results');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/agent.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
