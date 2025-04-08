<?php

namespace App\Livewire\Partials;

use App\Models\County;
use Livewire\Component;

class Search extends Component
{
    public $countyQuery = '';
    public $counties = [];
    public $locale;

    public $showDropdown = false;

    public function mount(): void
    {
        $this->locale = app()->getLocale();
    }

    public function render()
    {
        return view('livewire.partials.search');
    }

    public function searchCounties(): void
    {
        $this->showDropdown = true;
        $this->counties = County::where('name', 'like', '%' . $this->countyQuery . '%')
            ->limit(10)
            ->get();
    }

    public function selectCounty($countyName): void
    {
        $this->countyQuery = $countyName;
        $this->showDropdown = false;
    }

    protected $listeners = [
        'showDropdown' => 'showDropdown',
        'hideDropdown' => 'hideDropdown',
    ];

    public function showDropdown(): void
    {
        $this->showDropdown = true;
    }

    public function hideDropdown(): void
    {
        $this->showDropdown = false;
    }
}
