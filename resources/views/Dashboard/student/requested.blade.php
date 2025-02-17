@extends('Dashboard.layouts.layouts')

@section('title', 'طلبات الطلاب')

@section('css')
    <link rel="stylesheet" href="{{ asset('Dashboard/assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <h3>طلبات الطلاب</h3>
    </div>

    @include('messages.errors')
    @include('messages.success')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">طلبات الطلاب</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updateStatus') }}" method="POST">
                    @csrf
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>رقم الطالب</th>
                                <th>الإسم</th>
                                <th>حالة المادة</th>
                                <th>تغيير الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->pivot->status }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status[{{ $student->id }}]" value="قيد المعالجة" 
                                                {{ $student->pivot->status === 'قيد المعالجة' ? 'checked' : '' }}>
                                            <label class="form-check-label">قيد المعالجة</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status[{{ $student->id }}]" value="مقبول" 
                                                {{ $student->pivot->status === 'مقبول' ? 'checked' : '' }}>
                                            <label class="form-check-label">مقبول</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status[{{ $student->id }}]" value="مرفوض" 
                                                {{ $student->pivot->status === 'مرفوض' ? 'checked' : '' }}>
                                            <label class="form-check-label">مرفوض</label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">لا يوجد طلاب</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('Dashboard/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('Dashboard/assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection