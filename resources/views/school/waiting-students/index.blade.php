@extends('layouts.school')
@section('css')
    @livewireStyles
@endsection
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
        @livewire('waiting-students', ['courses'=>$courses])
    </div>
</div>

@endsection

@section('js')
    @livewireScripts

@endsection
