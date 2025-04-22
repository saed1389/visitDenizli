<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountyController;
use App\Http\Controllers\Admin\CulinaryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FestivalController;
use App\Http\Controllers\Admin\GovernmentController;
use App\Http\Controllers\Admin\GovernmentTitleController;
use App\Http\Controllers\Admin\HandicraftController;
use App\Http\Controllers\Admin\HistoryPlaceController;
use App\Http\Controllers\Admin\HousingController;
use App\Http\Controllers\Admin\IndustriesController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MuseumPlaceController;
use App\Http\Controllers\Admin\NaturalPlaceController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TourismOfficeController;
use App\Http\Controllers\Admin\TraditionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;

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
    Route::post('history-places/delete-image', [HistoryPlaceController::class, 'deleteImage'])->name('history-places.delete-image');

    // Natural Place Routes
    Route::resource('natural-places', NaturalPlaceController::class)->except(['show', 'destroy']);
    Route::get('natural-places/delete/{id}', [NaturalPlaceController::class, 'delete'])->name('natural-places.destroy');
    Route::post('natural-places/upload', [NaturalPlaceController::class, 'upload'])->name('natural-places.upload');
    Route::post('natural-places/changeStatus/{id}/{status}', [NaturalPlaceController::class, 'changeStatus']);
    Route::post('natural-places/delete-image', [NaturalPlaceController::class, 'deleteImage'])->name('natural-places.delete-image');

    // Museums and Art Galleries Routes
    Route::resource('museum-places', MuseumPlaceController::class)->except(['show', 'destroy']);
    Route::get('museum-places/delete/{id}', [MuseumPlaceController::class, 'delete'])->name('museum-places.destroy');
    Route::post('museum-places/upload', [MuseumPlaceController::class, 'upload'])->name('museum-places.upload');
    Route::post('museum-places/changeStatus/{id}/{status}', [MuseumPlaceController::class, 'changeStatus']);
    Route::post('museum-places/delete-image', [MuseumPlaceController::class, 'deleteImage'])->name('museum-places.delete-image');

    // Local Festivals Routes
    Route::resource('local-festivals', FestivalController::class)->except(['show', 'destroy']);
    Route::get('local-festivals/delete/{id}', [FestivalController::class, 'delete'])->name('local-festivals.destroy');
    Route::post('local-festivals/upload', [FestivalController::class, 'upload'])->name('local-festivals.upload');
    Route::post('local-festivals/changeStatus/{id}/{status}', [FestivalController::class, 'changeStatus']);

    // Customs and Traditions Routes
    Route::resource('traditions', TraditionController::class)->except(['show', 'destroy']);
    Route::get('traditions/delete/{id}', [TraditionController::class, 'delete'])->name('traditions.destroy');
    Route::post('traditions/upload', [TraditionController::class, 'upload'])->name('traditions.upload');
    Route::post('traditions/changeStatus/{id}/{status}', [TraditionController::class, 'changeStatus']);

    // Handicrafts Routes
    Route::resource('handicrafts', HandicraftController::class)->except(['show', 'destroy']);
    Route::get('handicrafts/delete/{id}', [HandicraftController::class, 'delete'])->name('handicrafts.destroy');
    Route::post('handicrafts/upload', [HandicraftController::class, 'upload'])->name('handicrafts.upload');
    Route::post('handicrafts/changeStatus/{id}/{status}', [HandicraftController::class, 'changeStatus']);

    // Culinary Routes
    Route::resource('culinary', CulinaryController::class)->except(['show', 'destroy']);
    Route::get('culinary/delete/{id}', [CulinaryController::class, 'delete'])->name('culinary.destroy');
    Route::post('culinary/upload', [CulinaryController::class, 'upload'])->name('culinary.upload');
    Route::post('culinary/changeStatus/{id}/{status}', [CulinaryController::class, 'changeStatus']);

    // Events Routes
    Route::resource('events', EventController::class)->except(['show', 'destroy']);
    Route::get('events/delete/{id}', [EventController::class, 'delete'])->name('events.destroy');
    Route::post('events/upload', [EventController::class, 'upload'])->name('events.upload');
    Route::post('events/changeStatus/{id}/{status}', [EventController::class, 'changeStatus']);

    // News Routes
    Route::resource('news', NewsController::class)->except(['show', 'destroy']);
    Route::get('news/delete/{id}', [NewsController::class, 'delete'])->name('news.destroy');
    Route::post('news/upload', [NewsController::class, 'upload'])->name('news.upload');
    Route::post('news/changeStatus/{id}/{status}', [NewsController::class, 'changeStatus']);

    // Blog Routes
    Route::resource('blog', BlogController::class)->except(['show', 'destroy']);
    Route::get('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.destroy');
    Route::post('blog/upload', [BlogController::class, 'upload'])->name('blog.upload');
    Route::post('blog/changeStatus/{id}/{status}', [BlogController::class, 'changeStatus']);

    // Housing Routes
    Route::resource('housing', HousingController::class)->except(['show', 'destroy']);
    Route::get('housing/delete/{id}', [HousingController::class, 'delete'])->name('housing.destroy');
    Route::post('housing/upload', [HousingController::class, 'upload'])->name('housing.upload');
    Route::post('housing/changeStatus/{id}/{status}', [HousingController::class, 'changeStatus']);
    Route::post('housing/delete-image', [HousingController::class, 'deleteImage'])->name('housing.delete-image');

    // Tourism Offices Routes
    Route::resource('tourism-office', TourismOfficeController::class)->except(['show', 'destroy']);
    Route::get('tourism-office/delete/{id}', [TourismOfficeController::class, 'delete'])->name('tourism-office.destroy');
    Route::post('tourism-office/upload', [TourismOfficeController::class, 'upload'])->name('tourism-office.upload');
    Route::post('tourism-office/changeStatus/{id}/{status}', [TourismOfficeController::class, 'changeStatus']);

    // Industries Routes
    Route::resource('industries', IndustriesController::class)->except(['show', 'destroy']);
    Route::get('industries/delete/{id}', [IndustriesController::class, 'delete'])->name('industries.destroy');
    Route::post('industries/upload', [IndustriesController::class, 'upload'])->name('industries.upload');
    Route::post('industries/changeStatus/{id}/{status}', [IndustriesController::class, 'changeStatus']);

    // Investment Opportunities Routes
    Route::resource('investment', InvestmentController::class)->except(['show', 'destroy']);
    Route::get('investment/delete/{id}', [InvestmentController::class, 'delete'])->name('investment.destroy');
    Route::post('investment/upload', [InvestmentController::class, 'upload'])->name('investment.upload');
    Route::post('investment/changeStatus/{id}/{status}', [InvestmentController::class, 'changeStatus']);

    // Professional shots Routes
    Route::resource('photo', PhotoController::class)->except(['show', 'destroy', 'create']);
    Route::get('photo/delete/{id}', [PhotoController::class, 'delete'])->name('photo.destroy');

    // Video Gallery Routes
    Route::resource('video', VideoController::class)->except(['show', 'destroy', 'create']);
    Route::get('video/delete/{id}', [VideoController::class, 'delete'])->name('video.destroy');

    // Menus Routes
    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::post('menu/changeStatus/{id}/{status}', [MenuController::class, 'changeStatus']);

    // Users Routes
    Route::resource('user', UserController::class)->except(['show', 'destroy']);
    Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.destroy');
    Route::post('user/changeStatus/{id}/{status}', [UserController::class, 'changeStatus']);

    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');
});
