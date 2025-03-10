<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::where('county_id', Auth::user()->county_id)->orderBy('created_at', 'asc')->get();
        return view('agent.news-events.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('agent.news-events.news.create', compact('counties'));
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
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/news/', $imageName);
            $imageUrl = 'uploads/news/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/news/', $bannerName);
            $bannerUrl = 'uploads/news/' . $bannerName;
        } else {
            $bannerUrl = '';
        }

        $data = [
            'county_id' => Auth::user()->county_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => 0,
            'created_by' => Auth::user()->id,
        ];

        News::create($data);

        toastr()->success('Haber Başarıyla Eklendi.');

        return redirect()->route('agent.news.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $news = News::where('id', $id)->first();

        return view('agent.news-events.news.edit', compact('counties', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:news,slug,' . $news->id,
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/news/', $imageName);
            $imageUrl = 'uploads/news/' . $imageName;
        } else {
            $imageUrl = $news->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/news/', $bannerName);
            $bannerUrl = 'uploads/news/' . $bannerName;
        } else {
            $bannerUrl = $news->banner_image;
        }

        $data = [
            'county_id' => Auth::user()->county_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => 0,
            'updated_by' => Auth::user()->id,
        ];

        News::where('id', $id)->update($data);

        toastr()->success('Haber Başarıyla Güncellendi.');

        return redirect()->route('agent.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $news = News::where('id', $id)->first();
        @unlink($news->image);
        @unlink($news->banner_image);
        $news->delete();

        toastr()->success('Haber Başarıyla Silindi.');

        return redirect()->route('agent.news.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news/'), $fileName);

            $url = asset('uploads/news/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }
}
