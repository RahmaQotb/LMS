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
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>رقم الطالب</th>
                            <th>الإسم</th>
                            <th>حالة المادة</th>
                            <th>تاريخ الإضافة</th>
                            <th>الإجراءات</th> <!-- عمود الإجراءات -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    @if ($student->subjects->contains($subject))
                                        {{ $student->subjects->find($subject->id)->pivot->status }}
                                    @else
                                        لم يطلب المادة
                                    @endif
                                </td>
                                <td>{{ $student->created_at }}</td>
                                <td>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">لا يوجد طلاب</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('Dashboard/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('Dashboard/assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection