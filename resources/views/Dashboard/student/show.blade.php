@extends('Dashboard.layouts.layouts')

@section('title', 'تفاصيل الطالب')

@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('Dashboard/assets/compiled/css/table-datatable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
@section('scripts')
    <script src="{{ asset('Dashboard/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('Dashboard/assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection

<div class="page-heading">
    <h3>درجات التلميذ</h3>
</div>

@include('messages.errors')
@include('messages.success')

<section class="section">
    <div class="row">
        <!-- Student Information Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">معلومات التلميذ</h5>
                </div>
                <div class="card-body">
                    <p><strong>اسم التلميذ:</strong> {{ $student->name }}</p>
                    <p><strong>رقم التلميذ:</strong> {{ $student->id }}</p>
                    <p><strong>تاريخ الإنشاء:</strong> {{ $student->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>

        <!-- Exams and Grades Card -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title">الاختبارات والدرجات</h5>
                </div>
                <div class="card-body">
                    @if ($student->exams->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>اسم الاختبار</th>
                                        <th>درجة التلميذ في اختبار الذكاء</th>
                                        <th>مستوى الصعوبة في اختبار الحساب</th>
                                        <th>درجة التلميذ في اختبار القراءة</th>
                                        <th>مستوى الصعوبة في اختبار القراءة</th>
                                        <th>درجة التلميذ  في اختبار القراءة</th>

                                        <th>تاريخ الاختبار</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->exams as $exam)
                                        <tr>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->pivot->intelligence_level_degree ?? 'غير محدد' }}</td>
                                            <td>{{ $exam->pivot->Math_difficulty ?? 'غير محدد' }}</td>
                                            <td>{{ $exam->pivot->Math_degree ?? 'غير محدد' }}</td>
                                            <td>{{ $exam->pivot->Arabic_difficulty ?? 'غير محدد' }}</td>
                                            <td>{{ $exam->pivot->Arabic_degree ?? 'غير محدد' }}</td>
                                            <td>{{ $exam->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            لا توجد اختبارات مسجلة لهذا الطالب.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection