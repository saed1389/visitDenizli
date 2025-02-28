<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $festivals = Festival::orderBy('county_id', 'asc')->get();
        return view('admin.culture.festivals.index', compact('festivals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.culture.festivals.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:festivals,slug',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/culture/', $imageName);
            $imageUrl = 'uploads/culture/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/culture/', $bannerName);
            $bannerUrl = 'uploads/culture/' . $bannerName;
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
            'created_by' => Auth::user()->id,
        ];

        Festival::create($data);

        toastr()->success('Yerel Festival Başarıyla Eklendi.');

        return redirect()->route('admin.local-festivals.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $festival = Festival::where('id', $id)->first();

        return view('admin.culture.festivals.edit', compact('counties', 'festival'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $festival = Festival::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:festivals,slug,' . $festival->id,
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/culture/', $imageName);
            $imageUrl = 'uploads/culture/' . $imageName;
        } else {
            $imageUrl = $festival->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/culture/', $bannerName);
            $bannerUrl = 'uploads/culture/' . $bannerName;
        } else {
            $bannerUrl = $festival->banner_image;
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
            'updated_by' => Auth::user()->id,
        ];

        Festival::where('id', $id)->update($data);

        toastr()->success('Yerel Festival Başarıyla Güncellendi.');

        return redirect()->route('admin.local-festivals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $history = Festival::where('id', $id)->first();
        @unlink($history->image);
        @unlink($history->banner_image);
        $history->delete();

        toastr()->success('Yerel Festival Başarıyla Silindi.');

        return redirect()->route('admin.local-festivals.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/culture/'), $fileName);

            $url = asset('uploads/culture/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        Festival::where('id', $id)->update(['status' => $status]);
    }
}
