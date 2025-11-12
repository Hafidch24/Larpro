<?php

namespace App\Http\Controllers;

use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $videos = Video::where('approved', true)
                     ->with('user')
                     ->latest()
                     ->paginate(9);
                     
        return view('dashboard.index', compact('videos'));
    }
    
    public function profile()
    {
      $video = Video::all();
        return view('dashboard.profile');
    }
}