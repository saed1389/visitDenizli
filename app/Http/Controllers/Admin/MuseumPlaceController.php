<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\MuseumPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MuseumPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = MuseumPlace::orderBy('county_id', 'asc')->get();
        return view('admin.visit_places.museum_places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.visit_places.museum_places.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:museum_places',
            'category' => 'required',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/places/', $imageName);
            $imageUrl = 'uploads/places/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/places/', $bannerName);
            $bannerUrl = 'uploads/places/' . $bannerName;
        } else {
            $bannerUrl = '';
        }

        $data = [
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'category' => $request->category,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        MuseumPlace::create($data);

        toastr()->success('Müze ve Sanat Galeri Başarıyla Eklendi.');

        return redirect()->route('admin.museum-places.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $place = MuseumPlace::where('id', $id)->first();

        return view('admin.visit_places.museum_places.edit', compact('counties', 'place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $place = MuseumPlace::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:museum_places,slug,' . $place->id,
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/places/', $imageName);
            $imageUrl = 'uploads/places/' . $imageName;
        } else {
            $imageUrl = $place->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/places/', $bannerName);
            $bannerUrl = 'uploads/places/' . $bannerName;
        } else {
            $bannerUrl = $place->banner_image;
        }

        $data = [
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'category' => $request->category,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        MuseumPlace::where('id', $id)->update($data);

        toastr()->success('Müze ve Sanat Galeri Başarıyla Güncellendi.');

        return redirect()->route('admin.museum-places.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $history = MuseumPlace::where('id', $id)->first();
        @unlink($history->image);
        @unlink($history->banner_image);
        $history->delete();

        toastr()->success('Müze ve Sanat Galeri Başarıyla Silindi.');

        return redirect()->route('admin.museum-places.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/places/'), $fileName);

            $url = asset('uploads/places/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        MuseumPlace::where('id', $id)->update(['status' => $status]);
    }
}
