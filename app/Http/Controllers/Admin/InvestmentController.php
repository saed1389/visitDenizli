<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\IndustriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndustriesDataTable $dataTable)
    {
        return $dataTable->render('admin.economy.investment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.economy.investment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
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
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Investment::create($data);

        toastr()->success('Yatırım Fırsatları Başarıyla Eklendi.');
        return redirect()->route('admin.investment.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $investment = Investment::where('id', $id)->first();
        return view('admin.economy.investment.edit', compact('investment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $investment = Investment::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'description' => 'required',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/economy/', $imageName);
            @unlink($investment->image);
            $imageUrl = 'uploads/economy/' . $imageName;
        } else {
            $imageUrl = $investment->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'image' => $imageUrl,
            'status' => $request->status,
        ];

        Investment::where('id', $id)->update($data);

        toastr()->success('Yatırım Fırsatları Başarıyla Güncellendi.');
        return redirect()->route('admin.investment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $investment = Investment::where('id', $id)->firstOrFail();
        @unlink($investment->image);
        $investment->delete();

        toastr()->success('Yatırım Fırsatları Başarıyla Silindi.');
        return redirect()->route('admin.investment.index');
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
        Investment::where('id', $id)->update(['status' => $status]);
    }
}
