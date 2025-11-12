@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                قائمة المشرف
            </div>
            <div class="card-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/dashboard">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/videos">إدارة الفيديوهات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">إدارة المستخدمين</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">لوحة تحكم المشرف</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-success h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">الفيديوهات المقبولة</h5>
                                <p class="card-text display-4">{{ $approvedVideos }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-warning h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">الفيديوهات المعلقة</h5>
                                <p class="card-text display-4">{{ $pendingVideos }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-info h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">إجمالي المستخدمين</h5>
                                <p class="card-text display-4">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection