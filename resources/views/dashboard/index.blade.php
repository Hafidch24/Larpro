@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                القائمة الجانبية
            </div>
            <div class="card-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/upload">رفع فيديو جديد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">حسابي</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">أحدث الفيديوهات</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($videos as $video)
                        @if($video->approved)
                            <div class="col-md-4 mb-4">
                                <div class="card video-card h-100">
                                    <video class="card-img-top video-thumbnail" controls>
                                        <source src="{{ asset($video->path) }}" type="video/mp4">
                                    </video>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        <p class="card-text">{{ Str::limit($video->description, 50) }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <small class="text-muted">نشر بواسطة: {{ $video->user->name }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection