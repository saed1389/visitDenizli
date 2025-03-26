<?php

namespace App\Livewire;

use App\Models\County;
use App\Models\Menu;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Category;
use App\Models\Housing;
use Livewire\WithPagination;

class CategoryPage extends Component
{
    use WithPagination;
    public $selectedCategorySlug;
    public $categories;
    public $menu;
    public $slug;
    public $housingList;

    // Add the missing property
    #[Url]
    public $selectedCategory = '';

    public $sortBy = 'name_asc';

    #[Url]
    public $searchKeyword = '';

    #[Url]
    public $selectedCounty = '';

    protected $listeners = ['resetFilters'];

    public function resetFilters(): void
    {
        $this->reset(['searchKeyword', 'selectedCounty', 'selectedCategory']);
    }

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->categories = Category::all();
        $this->selectedCategorySlug = $slug;
        $this->menu = Category::where('slug',  $this->slug)->first();

        // Set the selectedCategory if we have a slug
        if ($this->menu) {
            $this->selectedCategory = $this->menu->id;
        }
    }

    public function render()
    {
        $query = Housing::where('status', 1)->orderBy('created_at', 'desc');
        $types = 'category';

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
            })
            ->when($this->selectedCategory, function ($query) {
                return $query->where('category_id', $this->selectedCategory);
            });

        $housingLists = $query->paginate(6);
        $counties = County::where('status', 1)->get();
        $setting = getSetting();

        return view('livewire.category-page', [
            'housingLists' => $housingLists,
            'counties' => $counties,
            'categories' => $this->categories,
            'menu' => $this->menu,
            'setting' => $setting,
            'types' => $types,
        ]);
    }
}
