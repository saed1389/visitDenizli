<?php

namespace App\Livewire;

use App\Models\County;
use Livewire\Attributes\Url;
use Livewire\Component;

class CountyListPage extends Component
{
    public $menu;
    public $sortBy = 'name_asc';

    #[Url]
    public $searchKeyword = '';

    protected $listeners = ['resetFilters'];

    public function resetFilters(): void
    {
        $this->reset(['searchKeyword']);
    }

    public function render()
    {
        $query = null;

        $query = County::where('status', 1);


        if ($query) {
            $query->when($this->sortBy == 'name_asc', function ($query) {
                return $query->orderBy('name', 'asc');
            })
                ->when($this->sortBy == 'name_desc', function ($query) {
                    return $query->orderBy('name', 'desc');
                })
                ->when($this->searchKeyword, function ($query) {
                    return $query->where('name', 'like', '%' . $this->searchKeyword . '%');
                });

            $counties = $query->orderBy('created_at', 'desc')->get();
        } else {
            $counties = collect();
        }

        return view('livewire.county-list-page', [
            'counties' => $counties,
        ]);
    }
}
