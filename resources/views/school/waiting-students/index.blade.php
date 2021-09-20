@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Kurs ochilishini kutib navbatda turgan o'quvchilar statistikasi</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        <a href="{{ url('/school/waiting-students/create') }}" class="btn btn-success btn-sm" title="Add New WaitingStudent">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>T/R</th>
                        <th>Kurs nomi</th>
                        <th>O'quvchilar soni</th>

                    </tr>
                    @foreach($courses as $course)
                    <tr>
                        <td>183</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ count($course->waitingStudents) }}</td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">O'quvchilar ro'yhat
            </div>
            <div class="box-body">

                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Kurs</th>
                                <th>Telefon 1 </th>
                                <th>Telefon 2 </th>
                                <th>O'qish vaqti </th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($waitingstudents as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td><td>{{ $item->course->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->phone2 }}</td>
                                <td>{{ $item->course_time==1 ? 'Abetgacha': 'Abetdan keyin' }}</td>
                                <td>
                                    <a href="{{ url('/school/waiting-students/' . $item->id) }}" title="View WaitingStudent"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/school/waiting-students/' . $item->id . '/edit') }}" title="Edit WaitingStudent"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/waiting-students', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete WaitingStudent',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
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
