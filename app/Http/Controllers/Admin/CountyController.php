<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountyController extends Controller
{
    public function index(){
        $counties = County::orderBy('name', 'asc')->get();

        return view('admin.counties.index',compact('counties'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:counties',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/county/', $imageName);
            $imageUrl = 'uploads/county/' . $imageName;
        } else {
            $imageUrl = '';
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
        ];

        County::create($data);

        toastr()->success('İlçe Başarıyla Eklendi');

        return redirect()->route('admin.counties.index');
    }

    public function edit($id){
        $counties = County::orderBy('name', 'asc')->get();
        $county = County::whereId($id)->firstOrFail();
        return view('admin.counties.edit',compact('county', 'counties'));
    }

    public function update(Request $request, $id){
        $county = County::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|unique:counties,name,'.$id,
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/county/', $imageName);
            @unlink($county->image);
            $imageUrl = 'uploads/county/' . $imageName;
        } else {
            $imageUrl = $county->image;
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
        ];

        County::where('id', $id)->update($data);

        toastr()->success('İlçe Başarıyla Güncellendi');
        return redirect()->route('admin.counties.index');

    }

    public function delete($id) {
        $county = County::where('id', $id)->firstOrFail();
        @unlink($county->image);
        $county->delete();

        toastr()->success('İlçe Başarıyla Silindi');
        return redirect()->route('admin.counties.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/county/'), $fileName);

            $url = asset('uploads/county/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }
}
