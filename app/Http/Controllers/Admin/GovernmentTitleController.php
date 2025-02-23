<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GovernmentTitle;
use Illuminate\Http\Request;

class GovernmentTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = GovernmentTitle::all();
        return view('admin.governmentTitles.index', compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:government_titles,name',
            'name_en' => 'nullable',
        ]);

        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
        ];

        GovernmentTitle::create($data);

        toastr()->success('Ünvan Başarıyla Eklendi.');
        return redirect()->route('admin.governmentTitles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $titles = GovernmentTitle::all();
        $title = GovernmentTitle::whereId($id)->first();
        return view('admin.governmentTitles.edit', compact('titles', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|unique:government_titles,name,' . $id,
            'name_en' => 'nullable',
        ]);

        $data = [
            'name' => $request->name,
            'name_en' => $request->name_en,
        ];

        GovernmentTitle::where('id', $id)->update($data);
        toastr()->success('Ünvan Başarıyla Güncellendi.');
        return redirect()->route('admin.governmentTitles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        GovernmentTitle::where('id', $id)->delete();
        toastr()->success('Ünvan Başarıyla Silindi.');
        return redirect()->route('admin.governmentTitles.index');
    }
}
