<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Government;
use App\Models\Menu;
use Livewire\Attributes\Url;
use Livewire\Component;

class AboutPage extends Component
{
    public $slug;
    public $menu;
    public $sortBy = 'name_asc';
    public $members = [];

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
        $this->menu = Menu::where('parent_id', 1)->where('slug', $this->slug)->first();
        $this->sortMembers();
    }

    public function sortMembers(): void
    {
        $this->members = Government::where('status', 1)
            ->when($this->sortBy == 'name_asc', function ($query) {
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
            })
            ->get();
    }

    public function updatedSearchKeyword(): void
    {
        $this->sortMembers();
    }

    public function updatedSelectedCounty(): void
    {
        $this->sortMembers();
    }

    public function render()
    {
        if ($this->menu && $this->menu->id == 4) {
            $members = Government::where('status', 1)
                ->when($this->sortBy == 'name_asc', function ($query) {
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
                })
                ->get();

            $counties = County::where('status', 1)->get();
            return view('livewire.local-government-page', [
                'menu' => $this->menu,
                'members' => $members,
                'counties' => $counties,
            ]);
        }

        return view('livewire.about-page', [
            'menu' => $this->menu,
        ]);
    }
}
