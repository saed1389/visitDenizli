<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TourismOfficeDataTable;
use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\TourismOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TourismOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TourismOfficeDataTable $dataTable)
    {
        return $dataTable->render('admin.tourism.offices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.tourism.offices.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'status' => 'required',
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
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'image' => $imageUrl,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ];

        TourismOffice::create($data);

        toastr()->success(' Turizm Ofisleri  Başarıyla Eklendi.');

        return redirect()->route('admin.tourism-office.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $office = TourismOffice::where('id', $id)->first();

        return view('admin.tourism.offices.edit', compact('counties', 'office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $office = TourismOffice::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'status' => 'required',
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
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'image' => $imageUrl,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'status' => $request->status,
            'updated_by' => Auth::user()->id,
        ];

        TourismOffice::where('id', $id)->update($data);

        toastr()->success(' Turizm Ofisleri Başarıyla Güncellendi.');

        return redirect()->route('admin.tourism-office.index');
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

        return redirect()->route('admin.tourism-office.index');
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

    public function changeStatus($id, $status)
    {
        TourismOffice::where('id', $id)->update(['status' => $status]);
    }

    private function generateUniqueSlug($name, $currentModel = null, $currentId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        do {
            $conflict = false;

            if ($currentModel !== 'tourism_offices' || $currentId === null) {
                $conflict |= DB::table('tourism_offices')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('tourism_offices')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($currentModel !== 'housings' || $currentId === null) {
                $conflict |= DB::table('housings')->where('slug', $slug)->exists();
            } else {
                $conflict |= DB::table('housings')->where('slug', $slug)->where('id', '!=', $currentId)->exists();
            }

            if ($conflict) {
                $slug = $originalSlug . '-' . $counter++;
            }
        } while ($conflict);

        return $slug;
    }
}
