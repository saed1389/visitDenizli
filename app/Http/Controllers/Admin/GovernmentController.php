<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Government;
use App\Models\GovernmentTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governments = Government::orderBy('governmentTitle_id', 'asc')->get();
        return view('admin.government.index', compact('governments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = GovernmentTitle::orderBy('name')->get();
        $counties = County::where('status', 1)->orderBy('name', 'asc')->get();

        return view('admin.government.create', compact('titles', 'counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'governmentTitle_id' => 'required|exists:government_titles,id',
            'county_id' => 'nullable|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/government/', $imageName);
            $imageUrl = 'uploads/government/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'governmentTitle_id' => $request->governmentTitle_id,
            'county_id' => $request->county_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Government::create($data);

        toastr()->success('Yerel Yönetim Başarıyla Eklendi.');
        return redirect()->route('admin.government.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titles = GovernmentTitle::orderBy('name')->get();
        $counties = County::where('status', 1)->orderBy('name', 'asc')->get();
        $government = Government::where('id', $id)->first();
        return view('admin.government.edit', compact('government', 'titles', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $government = Government::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required',
            'governmentTitle_id' => 'required|exists:government_titles,id',
            'county_id' => 'nullable|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/county/', $imageName);
            @unlink($government->image);
            $imageUrl = 'uploads/county/' . $imageName;
        } else {
            $imageUrl = $government->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'governmentTitle_id' => $request->governmentTitle_id,
            'county_id' => $request->county_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Government::where('id', $id)->update($data);
        toastr()->success('Yerel Yönetim Başarıyla Güncellendi.');
        return redirect()->route('admin.government.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $government = Government::where('id', $id)->firstOrFail();
        @unlink($government->image);
        $government->delete();

        toastr()->success('Yerel Yönetim Başarıyla Silindi');
        return redirect()->route('admin.government.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/government/'), $fileName);

            $url = asset('uploads/government/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        Government::where('id', $id)->update(['status' => $status]);
    }
}
