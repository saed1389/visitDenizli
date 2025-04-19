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
        if ($this->menu && $this->menu->id == 22 ) {
            $type = 'map';
        } elseif ($this->menu  && $this->menu->id == 23 ) {
            $type = 'transportation ';
        } elseif ($this->menu  && $this->menu->id == 24 ) {
            $type = 'routes';
        }

        return view('livewire.map-page', [
            'menu' => $this->menu,
            'type' => $type,
        ]);
    }
}
