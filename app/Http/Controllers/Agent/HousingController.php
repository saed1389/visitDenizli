<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\County;
use App\Models\Housing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HousingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $housings = Housing::where('county_id', Auth::user()->county_id)->get();
        return view('agent.tourism.housing.index', compact('housings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('agent.tourism.housing.create', compact('counties', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:housings,slug',
            'county_id' => 'required|exists:counties,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable',
            'facebook' => 'nullable',
            'created_by' => 'nullable|exists:users,id',
        ]);

        $imageUrls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::slug($request->input('name')).'-'.time().'-'.uniqid().'.'.$image->extension();
                $image->move('uploads/housing/', $imageName);
                $imageUrls[] = 'uploads/housing/'.$imageName; // Store image path
            }
        }

        $data = [
            'county_id' => Auth::user()->county_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => json_encode($imageUrls),
            'website' => $request->website,
            'facebook' => $request->facebook,
            'status' => 0,
            'created_by' => Auth::user()->id,
        ];

        Housing::create($data);

        toastr()->success('Konaklama Rehberi Başarıyla Eklendi.');

        return redirect()->route('agent.housing.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $housing = Housing::where('id', $id)->first();

        return view('agent.tourism.housing.edit', compact('counties', 'housing', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $housing = Housing::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:housings,slug,'.$housing->id,
            'county_id' => 'required|exists:counties,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'images.*' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'website' => 'nullable',
            'facebook' => 'nullable',
            'created_by' => 'nullable|exists:users,id',
        ]);

        $existingImages = json_decode($housing->images, true) ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::slug($request->input('name')).'-'.time().'-'.uniqid().'.'.$image->extension();
                $image->move(public_path('uploads/housing/'), $imageName);
                $existingImages[] = 'uploads/housing/'.$imageName;
            }
        }

        if ($request->has('existing_images')) {
            $existingImages = explode(',', $request->input('existing_images'));
        }

        $housing->update([
            'county_id' => Auth::user()->county_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => json_encode($existingImages),
            'website' => $request->website,
            'facebook' => $request->facebook,
            'status' => 0,
            'updated_by' => Auth::user()->id,
        ]);

        toastr()->success('Konaklama Rehberi Başarıyla Güncellendi.');

        return redirect()->route('agent.housing.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $housing = Housing::findOrFail($id);

        $images = json_decode($housing->images, true) ?? [];

        foreach ($images as $image) {
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
        }

        $housing->delete();

        toastr()->success('Konaklama Rehberi Başarıyla Silindi.');

        return redirect()->route('agent.housing.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/housing/'), $fileName);

            $url = asset('uploads/housing/'.$fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function deleteImage(Request $request)
    {
        $housing = Housing::findOrFail($request->id);
        $images = json_decode($housing->images, true);

        if (($key = array_search($request->image, $images)) !== false) {
            unset($images[$key]);

            if (File::exists(public_path($request->image))) {
                File::delete(public_path($request->image));
            }

            $housing->update(['images' => json_encode(array_values($images))]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
