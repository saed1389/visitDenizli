<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function dashboard()
    {
        $newsCount = News::where('county_id', Auth::user()->county_id)->count();
        $eventCount = Event::where('county_id', Auth::user()->county_id)->count();
        return view('agent.dashboard', compact('newsCount', 'eventCount'));
    }
}
