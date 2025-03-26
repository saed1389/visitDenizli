<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Photo;
use App\Models\Video;
use Livewire\Component;

class GalleryPage extends Component
{
    public $slug;
    public $menu;

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->menu = Menu::where('parent_id', 7)->where('slug', $this->slug)->first();
    }

    public function render()
    {
        if ($this->menu && $this->menu->id == 20) {
            $photos = Photo::where('status', 1)->orderBy('created_at', 'desc')->get();
            return view('livewire.gallery-page', [
                'photos' => $photos,
                'menu' => $this->menu,
            ]);
        } else {
            $videos = Video::where('status', 1)->orderBy('created_at', 'desc')->get();
            return view('livewire.video-page', [
                'videos' => $videos,
                'menu' => $this->menu,
            ]);
        }
    }
}
