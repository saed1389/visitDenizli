<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\IndustriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Industries;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndustriesDataTable $dataTable)
    {
        return $dataTable->render('admin.economy.industries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.economy.industries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/economy/', $imageName);
            $imageUrl = 'uploads/economy/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Industries::create($data);

        toastr()->success('Yerel Ekonomi ve Sektörler Başarıyla Eklendi.');
        return redirect()->route('admin.industries.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $industry = Industries::where('id', $id)->first();
        return view('admin.economy.industries.edit', compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industry = Industries::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/economy/', $imageName);
            @unlink($industry->image);
            $imageUrl = 'uploads/economy/' . $imageName;
        } else {
            $imageUrl = $industry->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Industries::where('id', $id)->update($data);

        toastr()->success('Yerel Ekonomi ve Sektörler Başarıyla Güncellendi.');
        return redirect()->route('admin.industries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $industry = Industries::where('id', $id)->firstOrFail();
        @unlink($industry->image);
        $industry->delete();

        toastr()->success('Yerel Ekonomi ve Sektörler Başarıyla Silindi.');
        return redirect()->route('admin.industries.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/economy/'), $fileName);

            $url = asset('uploads/economy/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        Industries::where('id', $id)->update(['status' => $status]);
    }
}
