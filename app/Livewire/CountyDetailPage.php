<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Festival;
use App\Models\HistoryPlace;
use App\Models\Housing;
use App\Models\MuseumPlace;
use App\Models\NaturalPlace;
use App\Models\News;
use App\Models\Event;
use App\Models\TourismOffice;
use App\Models\Tradition;
use Livewire\Component;

class CountyDetailPage extends Component
{
    public $placeSlug;
    public $county;
    public $menu;

    // Define properties to hold data from each table
    public $festivals;
    public $historyPlaces;
    public $housings;
    public $museumPlaces;
    public $naturalPlaces;
    public $news;
    public $events;
    public $tourismOffices;
    public $traditions;

    public function mount($placeSlug): void
    {
        $this->placeSlug = $placeSlug;
        $this->loadPlace();
    }

    protected function loadPlace(): void
    {
        // Fetch the county details
        $this->county = County::where('slug', $this->placeSlug)->first();

        // Fetch data from each table based on county_id
        if ($this->county) {
            $this->festivals = Festival::where('county_id', $this->county->id)->get();
            $this->historyPlaces = HistoryPlace::where('county_id', $this->county->id)->get();
            $this->housings = Housing::where('county_id', $this->county->id)->get();
            $this->museumPlaces = MuseumPlace::where('county_id', $this->county->id)->get();
            $this->naturalPlaces = NaturalPlace::where('county_id', $this->county->id)->get();
            $this->news = News::where('county_id', $this->county->id)->get();
            $this->events = Event::where('county_id', $this->county->id)->whereRaw("STR_TO_DATE(start_date, '%d.%m.%Y %H:%i') > NOW()")->get();
            $this->tourismOffices = TourismOffice::where('county_id', $this->county->id)->get();
            $this->traditions = Tradition::where('county_id', $this->county->id)->get();
        }

        $this->menu = '/ilceler-listesi';
    }

    public function render()
    {
        return view('livewire.county-detail-page', [
            'county' => $this->county,
            'menu' => $this->menu,
            'festivals' => $this->festivals ?? collect(),
            'historyPlaces' => $this->historyPlaces ?? collect(),
            'housings' => $this->housings ?? collect(),
            'museumPlaces' => $this->museumPlaces ?? collect(),
            'naturalPlaces' => $this->naturalPlaces ?? collect(),
            'news' => $this->news ?? collect(),
            'events' => $this->events ?? collect(),
            'tourismOffices' => $this->tourismOffices ?? collect(),
            'traditions' => $this->traditions ?? collect(),
        ]);
    }
}
