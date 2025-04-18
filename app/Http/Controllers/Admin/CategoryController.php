<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
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
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'color' => 'nullable|string',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/categories/', $imageName);
            $imageUrl = 'uploads/categories/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('icon')) {
            $iconName = Str::slug($request->input('name')) . '-icon-' . time() . '.' . $request->icon->extension();
            $request->file('icon')->move('uploads/categories/icon/', $iconName);
            $iconUrl = 'uploads/categories/icon/' . $iconName;
        } else {
            $iconUrl = '';
        }

        $data = [
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'icon' => $iconUrl,
            'color' => $request->input('color'),
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
    public function edit(CategoryDataTable $dataTable, string $id)
    {
        $category = Category::whereId($id)->firstOrFail();
        return $dataTable->render('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'name_en' => 'nullable',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/categories/', $imageName);
            @unlink($category->image);
            $imageUrl = 'uploads/categories/' . $imageName;
        } else {
            $imageUrl = $category->image;
        }

        if ($request->hasFile('icon')) {
            $iconName = Str::slug($request->input('name')) . '-icon-' . time() . '.' . $request->icon->extension();
            $request->file('icon')->move('uploads/categories/icon/', $iconName);
            @unlink($category->icon);
            $iconUrl = 'uploads/categories/icon/' . $iconName;
        } else {
            $iconUrl = $category->image;
        }

        $data = [
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
            'color' => $request->input('color'),
            'icon' => $iconUrl,
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
        $category = Category::where('id', $id)->firstOrFail();
        @unlink($category->image);
        $category->delete();

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
