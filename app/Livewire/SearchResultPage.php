<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\County;
use App\Models\Event;
use App\Models\Housing;
use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SearchResultPage extends Component
{
    public ?string $query = null;
    public ?string $county = null;

    public function search(): void
    {
        if (empty($this->query) && empty($this->county)) {
            throw ValidationException::withMessages([
                'query' => 'Please enter a search term or select a county.',
                'county' => 'Please enter a search term or select a county.',
            ]);
        }
    }

    public function render()
    {
        if ($this->query && $this->county) {
            $this->search();
        }

        $lang = App::getLocale();
        $column = $lang === 'tr' ? 'name' : 'name_en';

        $news = News::with('county');
        $categories = Category::query();
        $places = Housing::with('county');
        $events = Event::with('county');

        if ($this->query) {
            if ($this->county) {
                $county = County::where('name', $this->county)->first();

                if (!$county) {
                    return view('livewire.search-result-page', [
                        'newsResults' => collect(),
                        'eventResults' => collect(),
                    ]);
                }

                $county_id = $county->id;

                $news->where($column, 'like', "%{$this->query}%")->where('county_id', $county_id);
                $categories->where($column, 'like', "%{$this->query}%")->where('county_id', $county_id);
                $places->where($column, 'like', "%{$this->query}%")->where('county_id', $county_id);
                $events->where($column, 'like', "%{$this->query}%")->where('county_id', $county_id);
            } else {
                $news->where($column, 'like', "%{$this->query}%");
                $categories->where($column, 'like', "%{$this->query}%");
                $places->where($column, 'like', "%{$this->query}%");
                $events->where($column, 'like', "%{$this->query}%");
            }
        } elseif ($this->county) {
            $news->whereHas('county', fn($q) => $q->where('name', $this->county));
            $places->whereHas('county', fn($q) => $q->where('name', $this->county));
            $events->whereHas('county', fn($q) => $q->where('name', $this->county));
        }


        return view('livewire.search-result-page', [
            'newsResults' => $news->get(),
            'eventResults' => $events->get(),
            'categoriesResults' => $categories->get(),
            'placesResults' => $places->get(),
            'query' => $this->query,
            'county' => $this->county,
        ]);
    }
}
