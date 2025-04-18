<?php

namespace App\Livewire\Partials;

use App\Models\Event;
use App\Models\Festival;
use App\Models\HistoryPlace;
use App\Models\Housing;
use App\Models\MuseumPlace;
use App\Models\NaturalPlace;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;

class MapComponent extends Component
{
    public $locations = [];

    public function mount(): void
    {
        $this->loadLocations();
    }

    public function loadLocations(): void
    {
        $event = Event::with('county')
            ->select('id', 'name', 'name_en', 'county_id', 'slug', 'latitude', 'longitude', 'description', 'description_en')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();

                $county = $item->county;

                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'event',
                    'imageApi' => route('api.location.image', ['type' => 'event', 'id' => $item->id]),
                    'icon' => asset('front/assets/images/icons/events.png'),
                    'color' => '#00ab94',
                    'detailUrl' => route('news.detail', [
                        'categorySlug' => 'yaklasan-etkinlikler',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $housing = Housing::with('category', 'county')
            ->select('id', 'name', 'name_en', 'county_id', 'slug', 'latitude', 'longitude', 'description', 'description_en', 'category_id')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();
                $category = $item->category;
                $county = $item->county;
                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'housing',
                    'category' => $category->name ?? 'Default',
                    'imageApi' => route('api.location.image', ['type' => 'housing', 'id' => $item->id]),
                    'icon' => $category->icon ?? asset('front/assets/images/def.png'),
                    'color' => $category->color ?? '#b91d1d',
                    'detailUrl' => route('tourism.detail', [
                        'categorySlug' => $category->slug ?? 'default',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $festival = Festival::with('county')
            ->select('id', 'name', 'name_en', 'slug', 'description', 'description_en', 'latitude', 'longitude', 'county_id')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();
                $county = $item->county;
                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'festival',
                    'imageApi' => route('api.location.image', ['type' => 'festival', 'id' => $item->id]),
                    'icon' => asset('front/assets/images/festivaller.png'),
                    'color' => $item->color ?? '#efd035',
                    'detailUrl' => route('culture.detail', [
                        'categorySlug' => 'yerel-festivaller',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $historyPlaces = HistoryPlace::with('county')
            ->select('id', 'name', 'name_en', 'slug', 'description', 'description_en', 'county_id', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();
                $county = $item->county;
                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'name_en' => $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'history',
                    'imageApi' => route('api.location.image', ['type' => 'history', 'id' => $item->id]),
                    'icon' => asset('front/assets/images/tarihi-mekanlar.png'),
                    'color' => $item->color ?? '#f86051',
                    'detailUrl' => route('place.detail', [
                        'categorySlug' => 'tarihi-mekanlar',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $museums = MuseumPlace::with('county')
            ->select('id', 'name', 'name_en', 'slug', 'description', 'description_en', 'latitude', 'longitude', 'county_id')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();
                $county = $item->county;
                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'museum',
                    'imageApi' => route('api.location.image', ['type' => 'museum', 'id' => $item->id]),
                    'icon' => asset('front/assets/images/muzeler.png'),
                    'color' => $item->color ?? '#d06ac6',
                    'detailUrl' => route('place.detail', [
                        'categorySlug' => 'muzeler-ve-sanat-galerileri',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $naturalPlaces = NaturalPlace::with('county')
            ->select('id', 'name', 'name_en', 'slug', 'description', 'description_en', 'latitude', 'longitude', 'county_id')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 1)
            ->get()
            ->map(function ($item) {
                $locale = App::getLocale();
                $county = $item->county;
                return [
                    'id' => $item->id,
                    'name' => $locale == 'tr' ? $item->name : $item->name_en,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'description' => $locale == 'tr' ? Str::limit(strip_tags($item->description) ) : Str::limit(strip_tags($item->description_en)),
                    'address' => 'Denizli - ' . ($county->name ?? ''),
                    'type' => 'natural',
                    'imageApi' => route('api.location.image', ['type' => 'natural', 'id' => $item->id]),
                    'icon' => asset('front/assets/images/dogal-guzellikler.png'),
                    'color' => $item->color ?? '#433ddf',
                    'detailUrl' => route('place.detail', [
                        'categorySlug' => 'dogal-guzellikler',
                        'placeSlug' => $item->slug
                    ]),
                ];
            });

        $this->locations = $event
            ->merge($housing)
            ->merge($festival)
            ->merge($historyPlaces)
            ->merge($museums)
            ->merge($naturalPlaces)
            ->toArray();
    }

    public function render()
    {
        return view('livewire.partials.map-component');
    }
}
