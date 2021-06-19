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
          <span class="info-box-number">{{ $num_courses }}<small>ta</small></span>
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
          <span class="info-box-number">{{ $num_teachers }}<small>ta</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
@endsection