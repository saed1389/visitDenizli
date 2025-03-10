<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Government;
use App\Models\GovernmentTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governments = Government::where('county_id', Auth::user()->county_id)->orderBy('created_at', 'asc')->get();
        return view('agent.government.index', compact('governments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = GovernmentTitle::orderBy('name')->get();
        $counties = County::where('status', 1)->orderBy('name', 'asc')->get();

        return view('agent.government.create', compact('titles', 'counties'));
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
            'created_by' => 'nullable|exists:users,id',
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
            'county_id' => Auth::user()->county_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => 0,
            'created_by' => Auth::user()->id,
        ];

        Government::create($data);

        toastr()->success('Yerel Yönetim Başarıyla Eklendi.');
        return redirect()->route('agent.government.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titles = GovernmentTitle::orderBy('name')->get();
        $counties = County::where('status', 1)->orderBy('name', 'asc')->get();
        $government = Government::where('id', $id)->first();
        return view('agent.government.edit', compact('government', 'titles', 'counties'));
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
            'updated_by' => 'nullable|exists:users,id',
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
            'county_id' => Auth::user()->county_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => 0,
            'updated_by' => Auth::user()->id,
        ];

        Government::where('id', $id)->update($data);

        toastr()->success('Yerel Yönetim Başarıyla Güncellendi.');
        return redirect()->route('agent.government.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $government = Government::where('id', $id)->firstOrFail();
        @unlink($government->image);
        $government->delete();

        toastr()->success('Yerel Yönetim Başarıyla Silindi.');
        return redirect()->route('agent.government.index');
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
}
