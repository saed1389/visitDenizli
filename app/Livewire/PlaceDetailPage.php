<?php

namespace App\Livewire;

use App\Models\HistoryPlace;
use App\Models\MuseumPlace;
use App\Models\NaturalPlace;
use Livewire\Component;

class PlaceDetailPage extends Component
{
    public $categorySlug;
    public $placeSlug;
    public $place;
    public $type;
    public $menu;

    public function mount($categorySlug, $placeSlug): void
    {
        $this->categorySlug = $categorySlug;
        $this->placeSlug = $placeSlug;
        $this->loadPlace();
    }

    protected function loadPlace(): void
    {
        $this->place = HistoryPlace::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'historical';
            $this->menu = '/gezilecek-yerler/tarihi-mekanlar';
            return;
        }

        $this->place = NaturalPlace::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'natural';
            $this->menu = '/gezilecek-yerler/dogal-guzellikler';
            return;
        }

        $this->place = MuseumPlace::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'museum';
            $this->menu = '/gezilecek-yerler/muzeler-ve-sanat-galerileri';
            return;
        }

        abort(404, 'Place not found');
    }

    protected function getRelatedPlaces()
    {
        if (!$this->place) {
            return collect();
        }

        $query = null;

        switch ($this->type) {
            case 'historical':
                $query = HistoryPlace::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'natural':
                $query = NaturalPlace::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'museum':
                $query = MuseumPlace::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            default:
                return collect();
        }

        return $query->limit(4)->get();
    }

    public function render()
    {
        // Fetch related places
        $relatedPlaces = $this->getRelatedPlaces();

        return view('livewire.place-detail-page', [
            'place' => $this->place,
            'type' => $this->type,
            'menu' => $this->menu,
            'relatedPlaces' => $relatedPlaces,
        ]);
    }
}
