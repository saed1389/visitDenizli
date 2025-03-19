<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view('admin.settings.menus.index', compact('menus'));
    }

    public function create() {
        return view('admin.settings.menus.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'title_en' => 'nullable',
            'parent_id' => 'required',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/menu/', $imageName);
            $imageUrl = 'uploads/menu/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('image_banner')) {

            $bannerName = Str::slug($request->input('title')) .'-banner' . '-' . time() . '.' . $request->image_banner->extension();
            $request->file('image_banner')->move('uploads/menu/', $bannerName);
            $bannerUrl = 'uploads/menu/' . $bannerName;
        } else {
            $bannerUrl = '';
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'title_en' => $request->title_en,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'image_banner' => $bannerUrl,
            'status' => $request->status,
        ];

        Menu::create($data);

        toastr()->success('Menü Başarıyla Eklendi.');
        return redirect()->route('admin.menu.index');
    }

    public function edit(string $id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('admin.settings.menus.edit', compact('menu'));
    }

    public function update(Request $request, string $id) {
        $menu = Menu::where('id', $id)->firstOrFail();
        $request->validate([
            'title' => 'required',
            'title_en' => 'nullable',
            'parent_id' => 'required',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/menu/', $imageName);
            @unlink($menu->image);
            $imageUrl = 'uploads/menu/' . $imageName;
        } else {
            $imageUrl = $menu->image;
        }

        if ($request->hasFile('image_banner')) {
            $bannerName = Str::slug($request->input('title')) .'-banner-' . time() . '.' . $request->image_banner->extension();
            $request->file('image_banner')->move('uploads/menu/', $bannerName);
            @unlink($menu->image_banner);
            $bannerUrl = 'uploads/menu/' . $bannerName;
        } else {
            $bannerUrl = $menu->image_banner;
        }

        $data = [
            'title' => $request->title,
            'title_en' => $request->title_en,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'image_banner' => $bannerUrl,
            'status' => $request->status,
        ];

        Menu::where('id', $id)->update($data);

        toastr()->success('Menü Başarıyla Güncellendi.');
        return redirect()->route('admin.menu.index');
    }

    public function destroy(string $id) {
        $menu = Menu::where('id', $id)->firstOrFail();
        @unlink($menu->image);
        @unlink($menu->image_banner);
        $menu->delete();

        toastr()->success('Menü Başarıyla Silindi.');
        return redirect()->route('admin.menu.index');
    }

    public function changeStatus($id, $status)
    {
        Menu::where('id', $id)->update(['status' => $status]);
    }
}
