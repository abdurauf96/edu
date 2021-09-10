@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jami o'quvchilar</span>
          <span class="info-box-number">{{ $num_students }}<small>ta</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-desktop" aria-hidden="true"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Kurslar</span>
          <span class="info-box-number">{{ count($courses) }}<small>ta</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-group" aria-hidden="true"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Guruxlar</span>
          <span class="info-box-number">{{ $num_groups }}<small>ta</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">O'qituvchilar</span>
          <span class="info-box-number">{{ count($teachers) }}<small>ta</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
     <div class="col-md-7">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">O'qituvchilar</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>F.I.O</th>
                    <th>Yo'nalishi</th>
                    <th style="width: 40px">O'quvchilar soni</th>
                </tr>

                @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> <a href="{{ route('teachers.show', $teacher->id) }}"> {{ $teacher->name }} </a></td>
                    <td>
                       @foreach ($teacher->courses as $course)
                        {{ $course->name }}
                       @endforeach
                    </td>
                    <td><span class="badge bg-blue">{{ count($teacher->students) }}</span></td>
                </tr>
                @endforeach
          </tbody>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Kurslar</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Kurs nomi</th>
              <th>O'quvchilar soni</th>

            </tr>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->name }}</td>

                <td><span class="badge bg-green">{{ count($course->activeStudents) }}</span></td>
            </tr>
            @endforeach

          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Jami o'quvchilar haqida ma'lumot</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>

            <tr>
                <td>1</td>
                <td>Jami o'quvchilar</td>
                <td><span class="badge bg-green">{{ $num_students }} ta</span></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ayni vaqt o'qimoqda</td>
              <td><span class="badge bg-green">{{ $active_students }} ta</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Bitirib ketgan </td>
              <td><span class="badge bg-green">{{ $num_students - $active_students }} ta</span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Chiqib ketgan </td>
              <td><span class="badge bg-green">{{ $out_students }} ta</span></td>
            </tr>
            <tr>
              <td>5</td>
              <td>Grant o'qimoqda</td>
              <td><span class="badge bg-green">{{ $grant_students }} ta</span></td>
            </tr>
            <tr>
              <td>6</td>
              <td>Bolalar soni</td>
              <td><span class="badge bg-green">{{ $boys }} ta</span></td>
            </tr>
            <tr>
              <td>7</td>
              <td>Qizlar soni</td>
              <td><span class="badge bg-green">{{ $girls }} ta</span></td>
            </tr>
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection
