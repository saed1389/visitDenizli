<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.gallery.shoot.index', compact('photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'shooter' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/gallery/', $imageName);
            $imageUrl = 'uploads/gallery/' . $imageName;

        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
            'shooter' => $request->shooter,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Photo::create($data);

        toastr()->success('Resim Başarıyla Eklendi.');
        return redirect()->route('admin.photo.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photos = Photo::all();
        $photo = Photo::where('id', $id)->first();
        return view('admin.gallery.shoot.edit', compact('photos', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $photo = Photo::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'shooter' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/gallery/', $imageName);
            @unlink($photo->image);
            $imageUrl = 'uploads/gallery/' . $imageName;
        } else {
            $imageUrl = $photo->image;
        }

        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
            'shooter' => $request->shooter,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Photo::where('id', $id)->update($data);

        toastr()->success('Resim Başarıyla Güncellendi.');
        return redirect()->route('admin.photo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $photo = Photo::where('id', $id)->firstOrFail();
        @unlink($photo->image);
        $photo->delete();

        toastr()->success('Resim Başarıyla Silindi.');
        return redirect()->route('admin.photo.index');
    }

    public function changeStatus($id, $status)
    {
        Photo::where('id', $id)->update(['status' => $status]);
    }
}
