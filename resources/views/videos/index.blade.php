<!-- videos/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    
    
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <video controls width="100%" poster="{{ $video->thumbnail_url }}">
                        <source src="{{ $video->video_url }}" type="video/mp4">
                        متصفحك لا يدعم تشغيل الفيديو
                    </video>
                    <h5 class="card-title mt-2">{{ $video->title }}</h5>
                    <p class="card-text">{{ Str::limit($video->description, 100) }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        نشر بواسطة: {{ $video->user->name }}
                    </small>
                    <a href="{{ route('videos.show', $video) }}" class="btn btn-sm btn-outline-primary">
                        مشاهدة
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $videos->links() }}
    </div>
</div>
@endsection