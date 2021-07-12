@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">O'quvchilar</span>
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
          <span class="info-box-text">Guruhlar</span>
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
                    <td>{{ $teacher->name }}</td>
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
               
                <td><span class="badge bg-green">{{ count($course->students) }}</span></td>
            </tr>
            @endforeach
            
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection