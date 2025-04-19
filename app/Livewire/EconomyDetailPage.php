<?php

namespace App\Livewire;

use App\Models\Industries;
use App\Models\Investment;
use Livewire\Component;

class EconomyDetailPage extends Component
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
        $this->place = Industries::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'industries';
            $this->menu = '/ekonomi/yerel-ekonomi-ve-sektorler';
            return;
        }

        $this->place = Investment::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'investment';
            $this->menu = '/ekonomi/yatirim-firsatlari';
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
            case 'industries':
                $query = Industries::where('status', 1)
                    ->where('id', '!=', $this->place->id);
                break;
            case 'investment':
                $query = Investment::where('status', 1)
                    ->where('id', '!=', $this->place->id);
                break;
            default:
                return collect();
        }

        return $query->inRandomOrder()->limit(4)->get();
    }
    public function render()
    {
        $relatedPlaces = $this->getRelatedPlaces();
        $setting = getSetting();
        return view('livewire.economy-detail-page',[
            'place' => $this->place,
            'type' => $this->type,
            'menu' => $this->menu,
            'relatedPlaces' => $relatedPlaces,
            'setting' => $setting
        ]);
    }
}
