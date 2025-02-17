@extends('Dashboard.layouts.layouts')

@section('title', 'الطلاب')

@section('css')
    <link rel="stylesheet" href="{{ asset('Dashboard/assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <h3>الطلاب</h3>
    </div> 

    @include('messages.errors')
    @include('messages.success')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">قائمة الطلاب</h5>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 5px; justify-content: flex-end">
                <a href="{{ route('students.create') }}" class="btn btn-success">
                    إضافة طالب
                </a>
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
                                <th>تاريخ الإضافة</th>
                                <th colspan="2">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        @if ($student->pivot)
                                            {{ $student->pivot->status }}
                                        @else
                                            لم يطلب المادة
                                        @endif
                                    </td>
                                    <td>
                                        @if ($student->pivot)
                                            <select name="status[{{ $student->id }}]">
                                                <option value="قيد المعالجة" {{ $student->pivot->status === 'قيد المعالجة' ? 'selected' : '' }}>قيد المعالجة</option>
                                                <option value="مقبول" {{ $student->pivot->status === 'مقبول' ? 'selected' : '' }}>مقبول</option>
                                                <option value="مرفوض" {{ $student->pivot->status === 'مرفوض' ? 'selected' : '' }}>مرفوض</option>
                                            </select>
                                        @else
                                            <span>لم يطلب المادة</span>
                                        @endif
                                    </td>
                                    <td>{{ $student->created_at }}</td>
                                    <td>
                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-outline-success">عرض التفاصيل</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">لا يوجد طلاب</td>
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