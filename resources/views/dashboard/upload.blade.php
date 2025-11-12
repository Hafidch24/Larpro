@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">رفع فيديو جديد</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">عنوان الفيديو</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">وصف الفيديو</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label">ملف الفيديو</label>
                        <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video" accept="video/*" required>
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">رفع الفيديو</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection