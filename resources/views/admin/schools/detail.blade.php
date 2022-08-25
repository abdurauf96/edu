@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $school->company_name }}</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Markaz rahbari</th>
                            <th>Telefon</th>
                            <th>Manzili</th>
                            <th>Email</th>
                            <th>O'quvchilar soni</th>
                            <th>O'qituvchilar soni</th>
                            <th>Kurslar soni</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{ $school->id }}</td>
                            <td>{{ $school->director }}</td>
                            <td>{{ $school->phone }}</td>
                            <td>{{ $school->addres }}</td>
                            <td>{{ $school->email }}</td>
                            <td><span class="label label-primary">{{ $school->students_count }} ta </span></td>
                            <td><span class="label label-primary">{{ $school->teachers_count }} ta</span></td>
                            <td><span class="label label-primary">{{ $school->courses_count }} ta</span></td>
                            <td>@if($school->status==1) <span class='label label-success'>Faol </span> @else <span class="label label-danger">Faol emas </span> @endif</td>
                        </tr>

                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
