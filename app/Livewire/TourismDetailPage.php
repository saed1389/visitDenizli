<?php

namespace App\Livewire;

use App\Models\Housing;
use App\Models\TourismOffice;
use Livewire\Component;

class TourismDetailPage extends Component
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
        $this->place = Housing::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'housing';
            $this->menu = '/turizm/konaklama-rehberi';
            return;
        }

        if ($this->place) {
            $this->type = 'transport';
            $this->menu = '/turizm/ulasim-bilgileri';
            return;
        }

        $this->place = TourismOffice::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'office';
            $this->menu = '/turizm/turizm-ofisleri';
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
            case 'housing':
                $query = Housing::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'office':
                $query = TourismOffice::where('status', 1)
                    ->where('id', '!=', $this->place->id);
                break;
            default:
                return collect();
        }

        return $query->limit(4)->get();
    }

    public function render()
    {
        $relatedPlaces = $this->getRelatedPlaces();
        if ($this->type == 'housing') {
            return view('livewire.housing-detail-page', [
                'place' => $this->place,
                'type' => $this->type,
                'placeSlug' => $this->placeSlug,
                'relatedPlaces' => $relatedPlaces,
            ]);
        } else {
            return view('livewire.tourism-detail-page', [
                'place' => $this->place,
                'type' => $this->type,
                'placeSlug' => $this->placeSlug,
                'relatedPlaces' => $relatedPlaces,
            ]);
        }
    }
}
