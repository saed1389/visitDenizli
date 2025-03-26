<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class MapPage extends Component
{
    public $slug;
    public $menu;

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->menu = Menu::where('parent_id', 8)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        return view('livewire.map-page', [
            'menu' => $this->menu,
        ]);
    }
}
