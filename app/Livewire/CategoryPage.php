<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Housing;

class CategoryPage extends Component
{
    public $selectedCategorySlug;
    public $categories;
    public $housingList;

    public function mount($slug = null)
    {
        $this->categories = Category::all();
        $this->selectedCategorySlug = $slug; // Store the selected category slug
    }

    public function render()
    {
        // Get housing list based on the selected category slug
        $this->housingList = Housing::when($this->selectedCategorySlug, function ($query) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->selectedCategorySlug);
            });
        })->latest()->get();

        return view('livewire.category-page', [
            'housingList' => $this->housingList,
            'categories' => $this->categories
        ]);
    }
}
