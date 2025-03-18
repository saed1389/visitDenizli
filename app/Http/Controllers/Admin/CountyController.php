<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountyDataTable;
use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountyController extends Controller
{
    public function index(CountyDataTable $dataTable){
        return $dataTable->render('admin.counties.index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:counties',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        if ($request->hasFile('banner_image')) {

            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/county/', $bannerName);
            $bannerUrl = 'uploads/county/' . $bannerName;
        } else {
            $bannerUrl = '';
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
        ];

        County::create($data);

        toastr()->success('İlçe Başarıyla Eklendi');

        return redirect()->route('admin.counties.index');
    }

    public function edit(CountyDataTable $dataTable, $id){

        $county = County::whereId($id)->firstOrFail();
        return $dataTable->render('admin.counties.edit',compact('county'));
    }

    public function update(Request $request, $id){
        $county = County::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required|unique:counties,name,'.$id,
            'description' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/county/', $imageName);
            @unlink($county->image);
            $imageUrl = 'uploads/county/' . $imageName;
        } else {
            $imageUrl = $county->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/county/', $bannerName);
            @unlink($county->banner_image);
            $bannerUrl = 'uploads/county/' . $bannerName;
        } else {
            $bannerUrl = $county->image;
        }

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'description_en' => $request->input('description_en'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
        ];

        County::where('id', $id)->update($data);

        toastr()->success('İlçe Başarıyla Güncellendi');
        return redirect()->route('admin.counties.index');

    }

    public function delete($id) {
        $county = County::where('id', $id)->firstOrFail();
        @unlink($county->image);
        @unlink($county->banner_image);
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
