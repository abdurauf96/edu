@extends('layouts.teacher')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header"> <h3> O'quvchilar</h3>
                    {{--                <a href="{{ url('/school/students/create') }}" class="btn btn-success btn-sm" title="Add New Student">--}}
                    {{--                        <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish--}}
                    {{--                </a>--}}
                </div>
                <div class="box-body">

                    <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                        <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Guruh</th>

                                <th>Telefon</th>
                                <th>Manzil</th>

                                <th>Rasm</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->guard('teacher')->user()->students as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> {{ $item->group->name }} </td>

                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td>

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
