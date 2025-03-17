<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Culinary;
use App\Models\Festival;
use App\Models\Handicraft;
use App\Models\Menu;
use App\Models\Tradition;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CulturePage extends Component
{
    use WithPagination; // Enable Livewire pagination

    public $slug;
    public $menu;
    public $sortBy = 'name_asc';

    #[Url]
    public $searchKeyword = '';

    #[Url]
    public $selectedCounty = '';

    protected $listeners = ['resetFilters'];

    public function resetFilters(): void
    {
        $this->reset(['searchKeyword', 'selectedCounty']);
    }

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->menu = Menu::where('parent_id', 3)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        $query = null;

        if ($this->menu && $this->menu->id == 8) {
            $query = Festival::where('status', 1);
        } elseif ($this->menu && $this->menu->id == 9) {
            $query = Tradition::where('status', 1);
        } elseif ($this->menu && $this->menu->id == 10) {
            $query = Handicraft::where('status', 1);
        } elseif ($this->menu && $this->menu->id == 11) {
            $query = Culinary::where('status', 1);
        }

        if ($query) {
            $query->when($this->sortBy == 'name_asc', function ($query) {
                return $query->orderBy('name', 'asc');
            })
                ->when($this->sortBy == 'name_desc', function ($query) {
                    return $query->orderBy('name', 'desc');
                })
                ->when($this->searchKeyword, function ($query) {
                    return $query->where('name', 'like', '%' . $this->searchKeyword . '%');
                })
                ->when($this->selectedCounty, function ($query) {
                    return $query->where('county_id', $this->selectedCounty);
                });

            $places = $query->get();
        } else {
            $places = collect();
        }

        $counties = County::where('status', 1)->get();
        return view('livewire.culture-page', [
            'menu' => $this->menu,
            'places' => $places,
            'counties' => $counties,
        ]);
    }
}
