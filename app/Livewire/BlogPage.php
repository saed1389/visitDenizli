<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPage extends Component
{
    use WithPagination; // Enable Livewire pagination

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

    public function render()
    {
        $query = null;
        $query = Blog::where('status', 1)->orderBy('created_at', 'desc');
        $recentBlogs = Blog::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        if ($query) {
        $query->when($this->sortBy == 'name_asc', function ($query) {
            return $query->orderBy('name', 'asc');
        })
            ->when($this->sortBy == 'name_desc', function ($query) {
                return $query->orderBy('name', 'desc');
            })
            ->when($this->searchKeyword, function ($query) {
                return $query->where('name', 'like', '%'.$this->searchKeyword.'%');
            });

            $blog = $query->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $blog = collect();
        }

        $setting = getSetting();

        return view('livewire.blog-page', [
            'recentBlogs' => $recentBlogs,
            'blogs' => $blog,
            'setting' => $setting
        ]);
    }
}
