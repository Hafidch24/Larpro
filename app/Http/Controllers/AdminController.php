<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function index()
    {
        $approvedVideos = Video::where('approved', true)->count();
        $pendingVideos = Video::where('approved', false)->count();
        $totalUsers = User::count();
        
        return view('admin.index', compact('approvedVideos', 'pendingVideos', 'totalUsers'));
    }

    public function videos()
    {
        $videos = Video::with('user')->latest()->get();
        return view('admin.videos', compact('videos'));
    }

    public function approve($id)
    {
        $video = Video::findOrFail($id);
        $video->update(['approved' => true]);
        
        return back()->with('success', 'تم قبول الفيديو بنجاح');
    }

    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id);
        Storage::disk('public')->delete($video->path);
        $video->delete();
        
        return back()->with('success', 'تم حذف الفيديو بنجاح');
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // حذف فيديوهات المستخدم أولاً
        foreach ($user->videos as $video) {
            Storage::disk('public')->delete($video->path);
            $video->delete();
        }
        
        $user->delete();
        
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}