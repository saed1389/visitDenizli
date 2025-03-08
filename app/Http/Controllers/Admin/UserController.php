<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'agent')->orderBy('county_id', 'asc')->get();

        return view('admin.settings.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::where('status', 1)->get();
        return view('admin.settings.users.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'county_id' => 'required|exists:counties,id',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'county_id' => $request->county_id,
            'status' => $request->status,
            'role' => 'agent',
        ];
        User::create($data);

        toastr()->success('Kullanıcı başarıyla eklendi.');
        return redirect()->route('admin.user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $counties = County::where('status', 1)->get();
        return view('admin.settings.users.edit', compact('user', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
            'county_id' => 'required|exists:counties,id',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'county_id' => $request->county_id,
            'status' => $request->status,
        ];
        User::where('id', $id)->update($data);

        toastr()->success('Kullanıcı başarıyla güncellendi.');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $user->delete();

        toastr()->success('Kullanıcı Başarıyla Silindi.');
        return redirect()->route('admin.investment.index');
    }

    public function changeStatus($id, $status)
    {
        User::where('id', $id)->update(['status' => $status]);
    }
}
