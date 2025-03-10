<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\TourismOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TourismOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = TourismOffice::where('county_id', Auth::user()->county_id)->get();
        return view('agent.tourism.offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('agent.tourism.offices.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'unique:tourism_offices,slug',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/tourism/', $imageName);
            $imageUrl = 'uploads/tourism/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'county_id' => Auth::user()->county_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'image' => $imageUrl,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'status' => 0,
            'created_by' => Auth::user()->id,
        ];

        TourismOffice::create($data);

        toastr()->success(' Turizm Ofisleri  Başarıyla Eklendi.');

        return redirect()->route('agent.tourism-office.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $office = TourismOffice::where('id', $id)->first();

        return view('agent.tourism.offices.edit', compact('counties', 'office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $office = TourismOffice::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'slug' => 'unique:tourism_offices,slug,' . $office->id,
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/tourism/', $imageName);
            @unlink($office->image);
            $imageUrl = 'uploads/tourism/' . $imageName;
        } else {
            $imageUrl = $office->image;
        }

        $data = [
            'county_id' => Auth::user()->county_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'image' => $imageUrl,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'updated_by' => Auth::user()->id,
        ];

        TourismOffice::where('id', $id)->update($data);

        toastr()->success(' Turizm Ofisleri Başarıyla Güncellendi.');

        return redirect()->route('agent.tourism-office.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $office = TourismOffice::where('id', $id)->first();
        @unlink($office->image);
        $office->delete();

        toastr()->success('Turizm Ofisleri Başarıyla Silindi.');

        return redirect()->route('agent.tourism-office.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tourism/'), $fileName);

            $url = asset('uploads/tourism/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }
}
