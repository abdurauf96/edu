@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between"> <h4> O'qituvchilar </h4>
                    <a href="?export" class="btn btn-warning btn-sm">
                        <i class="fa fa-download" aria-hidden="true"></i> Yuklab olish
                    </a>

                </div>
                <div class="card-body">

                    <div class="table-responsive" >
                        <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Xudud</th>
                                <th>Markaz tashkil etilgan maktab</th>
                                <th>O'qituvchi</th>
                                <th>Tug'ilgan sanasi</th>
                                <th>Lavozimi</th>
                                <th>Telefon</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $teacher->getSchool->district->name ?? '' }}</td>
                                    <td>{{ $teacher->getSchool->company_name }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->birthday }}</td>
                                    <td>{{ $teacher->profession }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>{{ $teacher->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $teachers->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

