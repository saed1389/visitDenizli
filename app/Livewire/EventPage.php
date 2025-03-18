<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Event;
use App\Models\Menu;
use App\Models\News;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EventPage extends Component
{
    use WithPagination; // Enable Livewire pagination

    public $slug;
    public $menu;
    public $sortBy = 'name_asc';

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
        $this->menu = Menu::where('parent_id', 4)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        $query = null;

        if ($this->menu && $this->menu->id == 12) {
            $query = Event::where('status', 1)->orderBy('created_at', 'desc');
            $type = 'event';
            $recentEvents = Event::where('status', 1)
                ->whereRaw("STR_TO_DATE(end_date, '%d.%m.%Y %H:%i') > NOW()")
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } elseif ($this->menu && $this->menu->id == 13) {
            $query = News::where('status', 1);
            $type = 'news';
            $recentEvents = News::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        }

        if ($query) {
            $query->when($this->sortBy == 'name_asc', function ($query) {
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
                });

            $news = $query->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $news = collect();
        }
        $setting = getSetting();
        $counties = County::where('status', 1)->get();

        return view('livewire.event-page', [
            'menu' => $this->menu,
            'news' => $news,
            'counties' => $counties,
            'recentEvents' => $recentEvents,
            'setting' => $setting,
            'types' => $type,
        ]);
    }
}
