<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class ContactPage extends Component
{
    public $slug = 'iletisim';
    public $menu;

    public function mount(): void
    {
        $this->menu = Menu::where('parent_id', 9)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        $setting = getSetting();
        return view('livewire.contact-page', [
            'setting' => $setting,
            'menu' => $this->menu,
        ]);
    }
}
