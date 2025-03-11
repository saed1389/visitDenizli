<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        return view('admin.settings.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $request->validate([
            'site_name' => 'nullable',
            'site_email' => 'nullable',
            'site_phone' => 'nullable',
            'site_address' => 'nullable',
            'site_fb' => 'nullable',
            'site_twitter' => 'nullable',
            'site_instagram' => 'nullable',
            'site_youtube' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:24',
            'slider' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $logoName = 'logo-' . time() . '.' . $request->logo->extension();
            $request->file('logo')->move('uploads/settings/', $logoName);
            $logoUrl = 'uploads/settings/' . $logoName;
            @unlink($setting->logo);
        } else {
            $logoUrl = $setting->logo;
        }

        if ($request->hasFile('favicon')) {
            $favName = 'favicon-' . time() . '.' . $request->favicon->extension();
            $request->file('favicon')->move('uploads/categories/', $favName);
            $favUrl = 'uploads/categories/' . $favName;
            @unlink($setting->favicon);
        } else {
            $favUrl = $setting->favicon;
        }

        if ($request->hasFile('slider')) {
            $sliderName = 'slider-' . time() . '.' . $request->slider->extension();
            $request->file('slider')->move('uploads/categories/', $sliderName);
            $sliderUrl = 'uploads/categories/' . $sliderName;
            @unlink($setting->slider);
        } else {
            $sliderUrl = $setting->slider;
        }

        $data = [
            'site_name' => $request->input('site_name'),
            'site_email' => $request->input('site_email'),
            'site_phone' => $request->input('site_phone'),
            'site_address' => $request->input('site_address'),
            'site_fb' => $request->input('site_fb'),
            'site_twitter' => $request->input('site_twitter'),
            'site_instagram' => $request->input('site_instagram'),
            'site_youtube' => $request->input('site_youtube'),
            'logo' => $logoUrl,
            'favicon' => $favUrl,
            'slider' => $sliderUrl,
        ];

        Setting::where('id', '1')->update($data);
        toastr()->success('Ayarlar Başarıyla Güncellendi!');
        return redirect()->back();
    }
}
