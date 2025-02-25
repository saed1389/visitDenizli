<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function history() {
        $about = About::first();
        return view('admin.about.history', compact('about'));
    }

    public function historyUpdate(Request $request)
    {
        $about = About::first();
        $request->validate([
            'history' => 'required',
            'history_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'tarihce' . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/about/', $imageName);
            @unlink($about->h_image);
            $imageUrl = 'uploads/about/' . $imageName;
        } else {
            $imageUrl = $about->h_image;
        }

        $data = [
            'history' => $request->input('history'),
            'history_en' => $request->input('history_en'),
            'h_image' => $imageUrl,
        ];

        About::whereId( 1)->update($data);

        toastr()->success('Tarihçe Başarıyla Güncellendi');

        return redirect()->route('admin.about.history');
    }

    public function geographical() {
        $about = About::first();
        return view('admin.about.geographical', compact('about'));
    }

    public function geographicalUpdate(Request $request)
    {
        $about = About::first();
        $request->validate([
            'geographical' => 'required',
            'geographical_en' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'geographical' . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/about/', $imageName);
            @unlink($about->g_image);
            $imageUrl = 'uploads/about/' . $imageName;
        } else {
            $imageUrl = $about->g_image;
        }

        $data = [
            'geographical' => $request->input('geographical'),
            'geographical_en' => $request->input('geographical_en'),
            'g_image' => $imageUrl,
        ];

        About::whereId( 1)->update($data);

        toastr()->success('Coğrafi Bilgiler Başarıyla Güncellendi');

        return redirect()->route('admin.about.geographical');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about/'), $fileName);

            $url = asset('uploads/about/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }
}
