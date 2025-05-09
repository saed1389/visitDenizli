<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Category;
use App\Models\County;
use App\Models\Housing;
use App\Models\Event; // Assuming you have an Event model
use App\Models\News; // Assuming you have a News model
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home')]
    public $countyQuery = '';
    public $counties = [];
    public $showDropdown = false;

    public function render()
    {
        $setting = getSetting();
        $categories = Category::where('status', 1)->get();
        $cities = County::where('status', 1)
            ->inRandomOrder()
            ->take(6)
            ->get();
        $blogs = Blog::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $event = Event::where('status', 1)
            ->whereRaw("STR_TO_DATE(start_date, '%d.%m.%Y %H:%i') > NOW()")
            ->orderBy('created_at', 'desc')
            ->first();

        $news = News::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        return view('livewire.home-page', [
            'setting' => $setting,
            'categories' => $categories,
            'cities' => $cities,
            'blogs' => $blogs,
            'event' => $event,
            'news' => $news,
        ]);
    }

    public function searchCounties()
    {
        $this->showDropdown = true;
        $this->counties = County::where('name', 'like', '%' . $this->countyQuery . '%')
            ->limit(10)
            ->get();
    }

    public function selectCounty($countyName)
    {
        $this->countyQuery = $countyName;
        $this->showDropdown = false;
    }

    protected $listeners = [
        'showDropdown' => 'showDropdown',
        'hideDropdown' => 'hideDropdown',
    ];

    public function showDropdown()
    {
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }
}
