<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\News;
use Livewire\Component;

class EventDetailPage extends Component
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
        $this->place = Event::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'event';
            $this->menu = '/etkinlikler-ve-haberler/yaklasan-etkinlikler';
            return;
        }

        $this->place = News::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'news';
            $this->menu = '/etkinlikler-ve-haberler/guncel-haberler';
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
            case 'event':
                $query = Event::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'news':
                $query = News::where('status', 1)
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
        $relatedPlaces = $this->getRelatedPlaces();
        $setting = getSetting();

        return view('livewire.event-detail-page', [
            'place' => $this->place,
            'type' => $this->type,
            'menu' => $this->menu,
            'relatedPlaces' => $relatedPlaces,
            'setting' => $setting
        ]);
    }
}
