<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.news-events.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news-events.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:news,slug',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/news/', $imageName);
            $imageUrl = 'uploads/news/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Blog::create($data);

        toastr()->success('Blog Başarıyla Eklendi.');

        return redirect()->route('admin.blog.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::where('id', $id)->first();

        return view('admin.news-events.blog.edit', compact( 'blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:news,slug,' . $blog->id,
            'name_en' => 'nullable',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/news/', $imageName);
            $imageUrl = 'uploads/news/' . $imageName;
        } else {
            $imageUrl = $blog->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Blog::where('id', $id)->update($data);

        toastr()->success('Blog Başarıyla Güncellendi.');

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $blog = Blog::where('id', $id)->first();
        @unlink($blog->image);
        $blog->delete();

        toastr()->success('Blog Başarıyla Silindi.');

        return redirect()->route('admin.blog.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog/'), $fileName);

            $url = asset('uploads/blog/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        Blog::where('id', $id)->update(['status' => $status]);
    }
}
