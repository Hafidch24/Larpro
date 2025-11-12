<?php
namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Str;

class VideoController extends Controller
{
    public function create()
    {
        return view('dashboard.upload');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'video' => 'required|file|mimes:mp4,mov,avi',
    ]);

    // معالجة رفع الفيديو
    $videoFile = $request->file('video');
    $videoName = time().'_'.Str::slug($videoFile->getClientOriginalName());
    $videoPath = 'uploads/videos/'.$videoName;
    
    // نقل الملف إلى public/uploads/videos
   // $videoFile->move(public_path('uploads/videos'), $videoName);

//تأكد من وجود المجلد
    if (!file_exists(public_path('uploads/videos'))) {
        mkdir(public_path('uploads/videos'), 0775, true);
    }
    
    // نقل الملف
    $videoFile->move(public_path('uploads/videos'), $videoName);


    // إنشاء سجل الفيديو في قاعدة البيانات
    Video::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'path' => $videoPath, // المسار النسبي بدءاً من public
        'approved' => auth()->user()->isAdmin(),
    ]);

    return redirect()->route('videos.index')->with('success', 'تم رفع الفيديو بنجاح');
}
    
    
    
  
    public function index()
    {
    $videos = Video::approved()->with('user')->latest()->paginate(9);
                     
        return view('videos.index', compact('videos'));
    }

    public function show(Video $video)
{
    // التحقق من صلاحية المشاهدة
    if (!$video->approved && !optional(auth()->user())->isAdmin()) {
        abort(403);
    }

    // زيادة عدد المشاهدات
    $video->incrementViews();

    // جلب الفيديوهات المقترحة
    $relatedVideos = Video::query()
        ->where('id', '!=', $video->id) // استبعاد الفيديو الحالي
        ->where('approved', true) // فقط الفيديوهات المقبولة
        ->when($video->user_id, function ($query) use ($video) {
            $query->where('user_id', $video->user_id); // فيديوهات لنفس المستخدم
        })
        ->inRandomOrder() // ترتيب عشوائي
        ->limit(4) // عدد الفيديوهات المقترحة
        ->get();

    return view('videos.show', [
        'video' => $video,
        'relatedVideos' => $relatedVideos
    ]);
}

    public function destroy(Video $video)
{
    // حذف الملف الفعلي
    if (file_exists(public_path($video->path))) {
        unlink(public_path($video->path));
    }
    
    // حذف السجل من قاعدة البيانات
    $video->delete();

    return redirect('/')->back()->with('success', 'تم حذف الفيديو بنجاح');
}
    
    
}