<?php

namespace App\Livewire;

use App\Models\Culinary;
use App\Models\Festival;
use App\Models\Handicraft;
use App\Models\Tradition;
use Livewire\Component;

class CultureDetailPage extends Component
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
        $this->place = Festival::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'festival';
            $this->menu = '/kultur-ve-sanat/yerel-festivaller';
            return;
        }

        $this->place = Tradition::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'tradition';
            $this->menu = '/kultur-ve-sanat/gelenek-ve-gorenekler';
            return;
        }

        $this->place = Handicraft::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'handicraft';
            $this->menu = '/kultur-ve-sanat/el-sanatlari';
            return;
        }

        $this->place = Culinary::where('slug', $this->placeSlug)->first();
        if ($this->place) {
            $this->type = 'culinary';
            $this->menu = '/kultur-ve-sanat/mutfak-kulturu';
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
            case 'festival':
                $query = Festival::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'tradition':
                $query = Tradition::where('status', 1)
                    ->where('id', '!=', $this->place->id)
                    ->where('county_id', $this->place->county_id);
                break;
            case 'handicraft':
                $query = Handicraft::where('status', 1)
                    ->where('id', '!=', $this->place->id);
                break;
            case 'culinary':
                $query = Culinary::where('status', 1)
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
        return view('livewire.culture-detail-page', [
            'place' => $this->place,
            'type' => $this->type,
            'placeSlug' => $this->placeSlug,
            'relatedPlaces' => $relatedPlaces,
        ]);
    }
}
