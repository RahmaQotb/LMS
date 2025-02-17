@extends('Dashboard.layouts.layouts')

@section('title', 'تعديل روابط المادة')

@section('content')
    <div class="page-heading">
        <h3>تعديل روابط المادة</h3>
    </div>

    @include('messages.errors')
    @include('messages.success')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $subject->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subjects.update', 1) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="drive_url" class="form-label">رابط Google Drive</label>
                        <input type="url" class="form-control" id="drive_url" name="drive_url" 
                            value="{{ old('drive_url', $subject->drive_url) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="google_form_url" class="form-label">رابط Google Form</label>
                        <input type="url" class="form-control" id="google_form_url" name="google_form_url" 
                            value="{{ old('google_form_url', $subject->google_form_url) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="youtube_url" class="form-label">رابط YouTube</label>
                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" 
                            value="{{ old('youtube_url', $subject->youtube_url) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </section>
@endsection