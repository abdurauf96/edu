@extends('layouts.school')
@section('css')
    @livewireStyles
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kurs ochilishini kutib navbatda turgan o'quvchilar statistikasi</h4>


                <div class="card-header-form">
                    <a href="{{ route('waiting-students.create') }}" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i>Yangi qo'shish </a>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>Kurs nomi</th>
                        <th>O'quvchilar soni</th>
                    </tr>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->waiting_students_count }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>Jami</th>
                        <th>{{ $all }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-12">
        @livewire('waiting-students', ['courses'=>$courses])
    </div>
</div>

@endsection

@section('js')
    @livewireScripts
@endsection
