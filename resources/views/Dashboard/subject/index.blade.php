@extends('Dashboard.layouts.layouts')

@section('title', 'تفاصيل المادة')

@section('content')
    <div class="page-heading">
        <h3>تفاصيل المادة</h3>
    </div>

    @include('messages.errors')
    @include('messages.success')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $subject->name }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>روابط المادة:</h6>
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>نوع الرابط</th>
                                <th>الرابط</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Google Drive</strong></td>
                                <td>
                                    @if($subject->drive_url)
                                        <a href="{{ $subject->drive_url }}" target="_blank">{{ $subject->drive_url }}</a>
                                    @else
                                        <span class="text-muted">لم يتم إضافة رابط</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Google Form</strong></td>
                                <td>
                                    @if($subject->google_form_url)
                                        <a href="{{ $subject->google_form_url }}" target="_blank">{{ $subject->google_form_url }}</a>
                                    @else
                                        <span class="text-muted">لم يتم إضافة رابط</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>YouTube</strong></td>
                                <td>
                                    @if($subject->youtube_url)
                                        <a href="{{ $subject->youtube_url }}" target="_blank">{{ $subject->youtube_url }}</a>
                                    @else
                                        <span class="text-muted">لم يتم إضافة رابط</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('subjects.edit', 1) }}" class="btn btn-primary">تعديل الروابط</a>
                </div>
            </div>
        </div>
    </section>
@endsection
