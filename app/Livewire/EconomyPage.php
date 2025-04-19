<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Industries;
use App\Models\Investment;
use App\Models\Menu;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EconomyPage extends Component
{
    use WithPagination; // Enable Livewire pagination

    public $slug;
    public $menu;
    public $sortBy = 'name_asc';

    #[Url]
    public $searchKeyword = '';

    protected $listeners = ['resetFilters'];

    public function resetFilters(): void
    {
        $this->reset(['searchKeyword']);
    }

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->menu = Menu::where('parent_id', 6)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        $query = null;

        if ($this->menu && $this->menu->id == 17) {
            $query = Industries::where('status', 1);
        } elseif ($this->menu && $this->menu->id == 18) {
            $query = Investment::where('status', 1);
        }

        if($query){
            $query->when($this->sortBy == 'name_asc', function ($query) {
                return $query->orderBy('name', 'asc');
            })
                ->when($this->sortBy == 'name_desc', function ($query) {
                    return $query->orderBy('name', 'desc');
                })
                ->when($this->searchKeyword, function ($query) {
                    return $query->where('name', 'like', '%' . $this->searchKeyword . '%');
                });

            $places = $query->get();
        } else {
            $places = collect();
        }

        return view('livewire.economy-page', [
            'places' => $places,
            'menu' => $this->menu,
        ]);
    }
}
