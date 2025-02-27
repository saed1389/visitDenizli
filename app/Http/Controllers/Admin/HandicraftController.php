<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Handicraft;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HandicraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $handicrafts = Handicraft::orderBy('name', 'asc')->get();
        return view('admin.culture.handicrafts.index', compact('handicrafts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.culture.handicrafts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:handicrafts,slug',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
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
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        Handicraft::create($data);

        toastr()->success('El Sanatları Başarıyla Eklendi.');

        return redirect()->route('admin.handicrafts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $handicraft = Handicraft::where('id', $id)->first();

        return view('admin.culture.handicrafts.edit', compact('handicraft'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $handicraft = Handicraft::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:handicrafts,slug,' . $handicraft->id,
            'name_en' => 'nullable',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/culture/', $imageName);
            $imageUrl = 'uploads/culture/' . $imageName;
        } else {
            $imageUrl = $handicraft->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/culture/', $bannerName);
            $bannerUrl = 'uploads/culture/' . $bannerName;
        } else {
            $bannerUrl = $handicraft->banner_image;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        Handicraft::where('id', $id)->update($data);

        toastr()->success('El Sanatları Başarıyla Güncellendi.');

        return redirect()->route('admin.handicrafts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $handicraft = Handicraft::where('id', $id)->first();
        @unlink($handicraft->image);
        @unlink($handicraft->banner_image);
        $handicraft->delete();

        toastr()->success('El Sanatları Başarıyla Silindi.');

        return redirect()->route('admin.handicrafts.index');
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
        Handicraft::where('id', $id)->update(['status' => $status]);
    }
}
