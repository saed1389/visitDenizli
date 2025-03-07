<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HistoryPlaceDataTable;
use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\HistoryPlace;
use Illuminate\Http\Request;
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
            'slug' => 'unique:history_places',
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
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imageUrl,
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
            'slug' => 'unique:history_places',
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
            $imageUrl = $history->image;
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
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imageUrl,
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
        @unlink($history->image);
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
}
