@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"> <h3> Monitoring</h3>
                {{-- <a href="{{ url('/admin/students/create') }}" class="btn btn-success btn-sm" title="Add New Student">
                        <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                </a> --}}
            </div>
            <div class="box-body">

                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                        <thead>
                            <tr>
                                <th>T/r</th>
                                <th>O'quvchi</th>
                                <th>Xodisa</th>
                                <th>Vaqt</th>
                                <th>Sana</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <a href="{{ route('students.show', $event->student_id) }}"> {{ $event->student->name  }} </a> </td>
                                <td> @if($event->status==1) <span class='label label-success'>Keldi </span> @else <span class='label label-danger'>Chiqib ketdi </span> @endif </td>
                                <td> {{ $event->time }} </td>
                                <td> {{ $event->created_at->format('d-M-Y') }} </td>
                              
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
{{-- <script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script> --}}
@endsection