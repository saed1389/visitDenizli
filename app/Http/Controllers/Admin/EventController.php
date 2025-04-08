<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EventDataTable;
use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EventDataTable $dataTable)
    {
        return $dataTable->render('admin.news-events.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.news-events.events.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'slug' => 'unique:events,slug',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'address' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'ticket_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/event/', $imageName);
            $imageUrl = 'uploads/event/' . $imageName;
        } else {
            $imageUrl = '';
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/event/', $bannerName);
            $bannerUrl = 'uploads/event/' . $bannerName;
        } else {
            $bannerUrl = '';
        }

        $data = [
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'ticket_link' => $request->ticket_link,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ];

        Event::create($data);

        toastr()->success('Etkinlik Başarıyla Eklendi.');

        return redirect()->route('admin.events.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $counties = County::where('status', 1)->get();
        $event = Event::where('id', $id)->first();

        return view('admin.news-events.events.edit', compact('counties', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'slug' => 'unique:events,slug,' . $event->id,
            'name_en' => 'nullable',
            'county_id' => 'required|exists:counties,id',
            'description' => 'required',
            'description_en' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'address' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'ticket_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('name')) . '-' . time() . '.' . $request->image->extension();
            $request->file('image')->move('uploads/event/', $imageName);
            $imageUrl = 'uploads/event/' . $imageName;
        } else {
            $imageUrl = $event->image;
        }

        if ($request->hasFile('banner_image')) {
            $bannerName = Str::slug($request->input('name')) . '-banner-' . time() . '.' . $request->banner_image->extension();
            $request->file('banner_image')->move('uploads/event/', $bannerName);
            $bannerUrl = 'uploads/event/' . $bannerName;
        } else {
            $bannerUrl = $event->banner_image;
        }

        $data = [
            'county_id' => $request->input('county_id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'name_en' => $request->name_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'ticket_link' => $request->ticket_link,
            'image' => $imageUrl,
            'banner_image' => $bannerUrl,
            'status' => $request->status,
            'updated_by' => Auth::user()->id,
        ];

        Event::where('id', $id)->update($data);

        toastr()->success('Etkinlik Başarıyla Güncellendi.');

        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $event = Event::where('id', $id)->first();
        @unlink($event->image);
        @unlink($event->banner_image);
        $event->delete();

        toastr()->success('Etkinlik Başarıyla Silindi.');

        return redirect()->route('admin.events.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/event/'), $fileName);

            $url = asset('uploads/event/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function changeStatus($id, $status)
    {
        Event::where('id', $id)->update(['status' => $status]);
    }
}
