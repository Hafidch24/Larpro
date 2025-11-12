@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">لوحة تحكم المشرف</h1>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الفيديوهات</h5>
                    <p class="card-text display-4">{{ $stats['totalVideos'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">فيديوهات مقبولة</h5>
                    <p class="card-text display-4">{{ $stats['approvedVideos'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">فيديوهات معلقة</h5>
                    <p class="card-text display-4">{{ $stats['pendingVideos'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">إجمالي المستخدمين</h5>
                    <p class="card-text display-4">{{ $stats['totalUsers'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>أحدث الفيديوهات</h5>
                </div>
                <div class="card-body">
                    <!-- قائمة بالفيديوهات الحديثة -->
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>أحدث المستخدمين</h5>
                </div>
                <div class="card-body">
                    <!-- قائمة بالمستخدمين الجدد -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
