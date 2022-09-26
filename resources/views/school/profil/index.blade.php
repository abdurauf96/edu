@extends('layouts.school')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $school->company_name }}</h4>
                </div>
                <div class="card-body table-responsive ">

                    <a href="{{ route('profile.edit', $school->id) }}" title="Edit Group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>

                    <br/>
                    <br/>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Markaz nomi</th> <td>{{ $school->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Markaz rahbari</th> <td>{{ $school->director }}</td>
                            </tr>
                            <tr>
                                <th>Telefon</th> <td>{{ $school->phone }}</td>
                            </tr>
                            <tr>
                                <th>Tuman</th> <td>{{ $school->district->name ?? null }}</td>
                            </tr>
                            <tr>
                                <th>Manzil</th> <td>{{ $school->addres }}</td>
                            </tr>
                            <tr>
                                <th>Email</th> <td>{{ $school->email }}</td>
                            </tr>
                            <tr>
                                <th>O'quvchilar soni</th> <td><span class="label label-primary">{{ $school->students_count }} ta </span></td>
                            </tr>
                            <tr>
                                <th>O'qituvchilar soni <td><span class="label label-primary">{{ $school->teachers_count }} ta</span></td></th>
                            </tr>
                            <tr>
                                <th>Kurslar soni</th>
                                <td><span class="label label-primary">{{ $school->courses_count }} ta</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>@if($school->status==1) <span class='badge badge-success'>Faol </span> @else <span class="label label-danger">Faol emas </span> @endif</td>
                            </tr>

                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
