<?php

namespace App\Livewire\Partials;

use App\Models\Category;
use App\Models\County;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $setting = getSetting();

        $popularCounties = County::withCount(['news', 'events'])
        ->orderByDesc('news_count')
        ->orderByDesc('events_count')
        ->get();

        $categories = Category::where('status', 1)->get();

        return view('livewire.partials.footer', [
            'setting' => $setting,
            'popularCounties' => $popularCounties,
            'categories' => $categories
        ]);
    }
}
