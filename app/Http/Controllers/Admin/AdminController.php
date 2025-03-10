<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $newsCount = News::where('status', 1)->count();
        $eventCount = Event::where('status', 1)->count();
        return view('admin.dashboard', compact('newsCount', 'eventCount'));
    }
}
