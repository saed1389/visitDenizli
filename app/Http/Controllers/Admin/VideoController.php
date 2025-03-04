<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.gallery.video.index', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'link' => 'required',
            'status' => 'required',
        ]);


        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
            'link' => $request->link,
            'status' => $request->status,
        ];

        Video::create($data);

        toastr()->success('Video Başarıyla Eklendi.');
        return redirect()->route('admin.video.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $videos = Video::all();
        $video = Video::where('id', $id)->first();
        return view('admin.gallery.video.edit', compact('video', 'videos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'link' => 'required',
            'status' => 'required',
        ]);


        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
            'link' => $request->link,
            'status' => $request->status,
        ];

        Video::where('id', $id)->update($data);

        toastr()->success('Video Başarıyla Güncellendi.');
        return redirect()->route('admin.video.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $video = Video::where('id', $id)->firstOrFail();
        $video->delete();

        toastr()->success('Video Başarıyla Silindi.');
        return redirect()->route('admin.video.index');
    }
}
