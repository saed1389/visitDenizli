<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CulinaryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Culinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CulinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CulinaryDataTable $dataTable)
    {
        return $dataTable->render('admin.culture.culinary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.culture.culinary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
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
            'slug' => $this->generateUniqueSlug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        Culinary::create($data);

        toastr()->success('Mutfak Kültürü Başarıyla Eklendi.');

        return redirect()->route('admin.culinary.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $culinary = Culinary::where('id', $id)->first();

        return view('admin.culture.culinary.edit', compact('culinary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $culinary = Culinary::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
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
            $imageUrl = $culinary->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/culture/', $bannerName);
            $bannerUrl = 'uploads/culture/' . $bannerName;
        } else {
            $bannerUrl = $culinary->banner_image;
        }

        $data = [
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
        ];

        Culinary::where('id', $id)->update($data);

        toastr()->success('Mutfak Kültürü Başarıyla Güncellendi.');

        return redirect()->route('admin.culinary.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $culinary = Culinary::where('id', $id)->first();
        @unlink($culinary->image);
        @unlink($culinary->banner_image);
        $culinary->delete();

        toastr()->success('Mutfak Kültürü Başarıyla Silindi.');

        return redirect()->route('admin.culinary.index');
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
        Culinary::where('id', $id)->update(['status' => $status]);
    }

    private function generateUniqueSlug($name, $currentModel = null, $currentId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        do {
            $conflict = false;

            if ($currentModel !== 'festivals' || $currentId === null) {
                $conflict |= DB::table('festivals')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('festivals')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'traditions' || $currentId === null) {
                $conflict |= DB::table('traditions')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('traditions')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'handicrafts' || $currentId === null) {
                $conflict |= DB::table('handicrafts')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('handicrafts')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'culinaries' || $currentId === null) {
                $conflict |= DB::table('culinaries')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('culinaries')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($conflict) {
                $slug = $originalSlug . '-' . $counter++;
            }
        } while ($conflict);

        return $slug;
    }
}
