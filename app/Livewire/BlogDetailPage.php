<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogDetailPage extends Component
{
    public $slug;
    public $blog;

    public function mount( $slug): void
    {
        $this->slug = $slug;
        $this->loadPlace();
    }

    protected function loadPlace(): void
    {
        $this->blog = Blog::where('slug', $this->slug)->first();
    }

    protected function getRelatedBlogs()
    {
        if (!$this->blog) {
            return collect();
        }

        $query = null;

        $query = Blog::where('status', 1)
            ->where('id', '!=', $this->blog->id);

        return $query->limit(4)->get();
    }

    public function render()
    {
        $relatedBlogs = $this->getRelatedBlogs();
        $setting = getSetting();

        return view('livewire.blog-detail-page', [
            'relatedBlogs' => $relatedBlogs,
            'setting' => $setting,
            'blog' => $this->blog,
        ]);
    }
}
