<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'name_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/categories/', $imageName);
            $imageUrl = 'uploads/categories/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => Str::slug($request->input('name')),
            'slug_en' => Str::slug($request->input('name_en')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
        ];

        Category::create($data);

        toastr()->success('Kategori Başarıyla Eklendi');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $category = Category::whereId($id)->firstOrFail();
        return view('admin.categories.edit',compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $county = Category::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'name_en' => 'nullable',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/categories/', $imageName);
            @unlink($county->image);
            $imageUrl = 'uploads/categories/' . $imageName;
        } else {
            $imageUrl = $county->image;
        }

        $data = [
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => Str::slug($request->input('name')),
            'slug_en' => Str::slug($request->input('name_en')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
        ];

        Category::where('id', $id)->update($data);

        toastr()->success('Kategori Başarıyla Güncellendi');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $county = Category::where('id', $id)->firstOrFail();
        @unlink($county->image);
        $county->delete();

        toastr()->success('Kategori Başarıyla Silindi');
        return redirect()->route('admin.categories.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/categories/'), $fileName);

            $url = asset('uploads/categories/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }
}
