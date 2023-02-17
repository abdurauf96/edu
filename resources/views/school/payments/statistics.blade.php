@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Kurslar bo'yicha qarzdorlar ko'rsatkichi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Kurs</th>
                            <th>Qarz miqdori</th>
                        </tr>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ number_format($course->debtor_students_sum_debt ?? 0, 0, '.', ',') ??  0 }} so'm</td>
                        </tr>
                        @endforeach
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

