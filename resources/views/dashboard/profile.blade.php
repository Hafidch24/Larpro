@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">معلومات الحساب</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; margin: 0 auto;">
                        <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">الاسم:</label>
                    <p class="form-control-static">{{ auth()->user()->name }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني:</label>
                    <p class="form-control-static">{{ auth()->user()->email }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">تاريخ التسجيل:</label>
                    <p class="form-control-static">{{ optional( auth()->user()->created_at)->format('Y-m-d') ?? 'ghir m3rof' }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- videos-->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">فيديوهاتي</h5>
            </div>
            <div class="card-body">
                @if(auth()->user()->videos->count() > 0)
                    <div class="row">
                        @foreach(auth()->user()->videos as $video)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <video class="card-img-top video-thumbnail" controls>
                                        <source src="{{ asset($video->path) }}" type="video/mp4">
                                    </video>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        <p class="card-text">{{ Str::limit($video->description, 50) }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <span class="badge bg-{{ $video->approved ? 'success' : 'warning' }}">
                                            {{ $video->approved ? 'مقبول' : 'في انتظار المراجعة' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        لم تقم برفع أي فيديوهات حتى الآن.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection