<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\County;
use App\Models\Housing;
use App\Models\Menu;
use App\Models\TourismOffice;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TourismPage extends Component
{
    use WithPagination; // Enable Livewire pagination

    public $slug;
    public $menu;
    public $sortBy = 'name_asc';

    #[Url]
    public $searchKeyword = '';

    #[Url]
    public $selectedCounty = '';

    #[Url]
    public $selectedCategory = '';

    protected $listeners = ['resetFilters'];

    public function resetFilters(): void
    {
        $this->reset(['searchKeyword', 'selectedCounty', 'selectedCategory']);
    }

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->menu = Menu::where('parent_id', 5)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        $query = null;

        if ($this->menu && $this->menu->id == 14) {
            $query = Housing::where('status', 1);
        } elseif ($this->menu && $this->menu->id == 16) {
            $query = TourismOffice::where('status', 1);
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
                })->when($this->selectedCategory, function ($query) {
                    return $query->where('category_id', $this->selectedCategory);
                });

            $places = $query->get();
        } else {
            $places = collect();
        }

        $counties = County::where('status', 1)->get();
        if ($this->menu && $this->menu->id == 14) {
            $categories = Category::where('status', 1)->get();
            return view('livewire.housing-page', [
                'places' => $places,
                'counties' => $counties,
                'menu' => $this->menu,
                'categories' => $categories,
            ]);
        } else {
            return view('livewire.tourism-page', [
                'places' => $places,
                'counties' => $counties,
                'menu' => $this->menu,
            ]);
        }
    }
}
