@extends('layouts.teacher')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Guruhlar

                </div>
                <div class="card-body">

                    <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                        <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                            <thead>
                            <tr>
                                <th>#</th><th>Nomi</th><th>O'qituvchi</th><th>Kurs</th> <th>Status</th><th>O'quvchilar soni</th>
{{--                                <th>Amallar</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name }}</td><td>{{ $item->teacher->name }}</td>
                                    <td>{{ $item->course->name }}</td>

                                    <td>{{ $item->status==1 ? 'Guruh to`lgan' : 'Guruh to\'lmoqda' }}</td>
                                    <td>{{ count($item->students) }} ta</td>
{{--                                    <td>--}}
{{--                                        <a href="{{ url('/school/groups/' . $item->id) }}" title="View Group"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>--}}
{{--                                        <a href="{{ url('/school/groups/' . $item->id . '/edit') }}" title="Edit Group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>--}}



{{--                                        <a href="{{ url('/school/groups/' . $item->id . '/add-student') }}" title="Add Student"><button class="btn btn-primary btn-md"><i class="fa fa-user-plus" aria-hidden="true"></i></button></a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $("#example1_wrapper").dataTable();
        })
    </script>
@endsection
