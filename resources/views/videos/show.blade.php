@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- مشغل الفيديو -->
                    <div class="video-player mb-4">
   
   {{--
    <video controls width="100%" class="rounded" poster="{{ $video->thumbnail_url ?? asset('images/default-thumbnail.jpg') }}">
    <source src="{{ asset($video->path) }}" type="video/mp4">
    متصفحك لا يدعم تشغيل الفيديو
</video>
--}}

{{-- <video controls>
    <source src="{{ asset('update/videos/1750454139_readme-calc-function-is-used-to-set-the-font-size-of-h1-element-to-be-a-combination-of-a-fixed-10-pixelidth-this-ensures-that-the-text-is-always-readable-and-scales-proportionally-with-the-screen-size-providing-a-responsi.mp4') }}" type="video/mp4">
</video>
--}}

<video controls width="100%" class="rounded" poster="{{ $video->thumbnail_url ?? asset('images/default-thumbnail.jpg') }}">
    @if(file_exists(public_path($video->path)))
        <source src="{{ asset($video->path) }}" type="video/mp4">
  

        <!-- أو عرض رسالة خطأ -->
        <p class="text-danger">الفيديو غير متوفر حالياً</p>
    @endif
    متصفحك لا يدعم تشغيل الفيديو
</video>


                    </div>
                    
                    <!-- معلومات الفيديو -->
                    <div class="video-info mb-4">
                        <h1 class="video-title mb-2">{{ $video->title }}</h1>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="video-views">
                                <span class="text-muted">
                                    <i class="fas fa-eye"></i> {{ $video->views_count }} مشاهدة
                                </span>
                            </div>
                            <div class="video-date">
                                <span class="text-muted">
                                    <i class="far fa-calendar-alt"></i> {{ $video->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="video-author mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block">{{ $video->user->name }}</span>
                                    <small class="text-muted">ناشر الفيديو</small>
                                </div>
                            </div>
                        </div>
                        
                        @if($video->description)
                        <div class="video-description card p-3 bg-light">
                            <h5 class="mb-2">وصف الفيديو</h5>
                            <p class="mb-0">{{ $video->description }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- أزرار التحكم -->
                    <div class="video-actions d-flex justify-content-between">
                        @auth
                            @if(auth()->user()->id === $video->user_id || auth()->user()->isAdmin())
                            <div class="action-buttons">
                                <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                
                                <form action="{{ route('videos.destroy', $video) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('هل أنت متأكد من حذف هذا الفيديو؟')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                            @endif
                            
                            <div class="social-share">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-share"></i> مشاركة
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- فيديوهات مقترحة -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">فيديوهات مقترحة</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($relatedVideos as $related)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <a href="{{ route('videos.show', $related) }}" class="flex-shrink-0 me-2">
                                    <video width="120" height="80" class="rounded">
                                        <source src="{{ $related->video_url }}" type="video/mp4">
                                    </video>
                                </a>
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('videos.show', $related) }}" class="text-decoration-none">
                                            {{ Str::limit($related->title, 40) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted d-block">{{ $related->user->name }}</small>
                                    <small class="text-muted">
                                        {{ $related->views_count }} مشاهدة • {{ $related->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .video-player {
        background-color: #000;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .video-title {
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .video-description {
        border-radius: 8px;
    }
</style>

<script>
    // إضافة تأثيرات عند تشغيل الفيديو
    document.querySelector('video').addEventListener('play', function() {
        // يمكنك إضافة أي تفاعلات هنا عند تشغيل الفيديو
        console.log('الفيديو يعمل الآن');
    });
</script>
@endsection