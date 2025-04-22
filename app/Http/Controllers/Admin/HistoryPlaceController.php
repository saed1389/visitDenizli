<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HistoryPlaceDataTable;
use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\HistoryPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HistoryPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HistoryPlaceDataTable $dataTable)
    {
        return $dataTable->render('admin.visit_places.history_places.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.visit_places.history_places.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $imageUrls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::slug($request->input('name')).'-'.time().'-'.uniqid().'.'.$image->extension();
                $image->move('uploads/places/', $imageName);
                $imageUrls[] = 'uploads/places/'.$imageName; // Store image path
            }
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
            'slug' => $this->generateUniqueSlug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude !== null ? (float) $request->latitude : null,
            'longitude' => $request->longitude !== null ? (float) $request->longitude : null,
            'images' => json_encode($imageUrls),
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        HistoryPlace::create($data);

        toastr()->success('Tarihi Mekan Başarıyla Eklendi.');

        return redirect()->route('admin.history-places.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $history = HistoryPlace::where('id', $id)->first();

        return view('admin.visit_places.history_places.edit', compact('counties', 'history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $history = HistoryPlace::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'images.*' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $existingImages = json_decode($history->images, true) ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::slug($request->input('name')).'-'.time().'-'.uniqid().'.'.$image->extension();
                $image->move(public_path('uploads/places/'), $imageName);
                $existingImages[] = 'uploads/places/'.$imageName;
            }
        }

        if ($request->has('existing_images')) {
            $existingImages = explode(',', $request->input('existing_images'));
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/places/', $bannerName);
            $bannerUrl = 'uploads/places/' . $bannerName;
        } else {
            $bannerUrl = $history->banner_image;
        }

        $data = [
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude !== null ? (float) $request->latitude : null,
            'longitude' => $request->longitude !== null ? (float) $request->longitude : null,
            'images' => json_encode($existingImages),
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        HistoryPlace::where('id', $id)->update($data);

        toastr()->success('Tarihi Mekan Başarıyla Güncellendi.');

        return redirect()->route('admin.history-places.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $history = HistoryPlace::where('id', $id)->first();
        $images = json_decode($history->images, true) ?? [];
        foreach ($images as $image) {
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
        }
        @unlink($history->banner_image);
        $history->delete();

        toastr()->success('Tarihi Mekan Başarıyla Silindi.');

        return redirect()->route('admin.history-places.index');
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
        HistoryPlace::where('id', $id)->update(['status' => $status]);
    }

    public function deleteImage(Request $request)
    {
        $history = HistoryPlace::findOrFail($request->id);
        $images = json_decode($history->images, true);

        if (($key = array_search($request->image, $images)) !== false) {
            unset($images[$key]);

            if (File::exists(public_path($request->image))) {
                File::delete(public_path($request->image));
            }

            $history->update(['images' => json_encode(array_values($images))]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    private function generateUniqueSlug($name, $currentModel = null, $currentId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        do {
            $conflict = false;

            if ($currentModel !== 'history_places' || $currentId === null) {
                $conflict |= DB::table('history_places')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('history_places')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'natural_places' || $currentId === null) {
                $conflict |= DB::table('natural_places')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('natural_places')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'museum_places' || $currentId === null) {
                $conflict |= DB::table('museum_places')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('museum_places')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($conflict) {
                $slug = $originalSlug . '-' . $counter++;
            }
        } while ($conflict);

        return $slug;
    }
}
