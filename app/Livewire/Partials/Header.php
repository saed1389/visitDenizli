<?php

namespace App\Livewire\Partials;

use App\Models\Menu;
use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $setting = getSetting();
        $menus = Menu::where('status', 1)->get();
        return view('livewire.partials.header', [
            'setting' => $setting,
            'menus' => $menus,
        ]);
    }
}
