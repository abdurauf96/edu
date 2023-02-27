@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Kurslar bo'yicha to'lovlar ko'rsatkichi (Natijalar joriy oy yakuni bo'yicha)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Kurs</th>
                            <th>To'lov holati</th>
                        </tr>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>
                                @if($course->students_sum_debt>=0)
                                <span class="badge badge-success">{{ number_format($course->students_sum_debt, 2, '.', ',') }} Xaqdormiz</span>
                                @else
                                    <span class="badge badge-danger">{{ number_format($course->students_sum_debt, 2, '.', ',') }} Qarzdormiz</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Jami</th>
                            <td>@if($totalDebt>=0)
                                    <span class="badge badge-info"> {{ number_format($totalDebt, 2, '.', ',') }} Xaqdormiz</span>
                                @else
                                    <span class="badge badge-danger"> {{ number_format($totalDebt, 2, '.', ',') }} Qarzdormiz</span>
                                @endif
                            </td>
                        </tr>
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

