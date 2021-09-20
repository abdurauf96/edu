@extends('layouts.school')

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
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">O'qituvchilar</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>F.I.O</th>
              <th>Yo'nalishi</th>
              <th style="width: 40px">O'quvchilar soni</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
              </td>
              <td><span class="badge bg-red">55%</span></td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Clean database</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                </div>
              </td>
              <td><span class="badge bg-yellow">70%</span></td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Cron job running</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                </div>
              </td>
              <td><span class="badge bg-light-blue">30%</span></td>
            </tr>
            <tr>
              <td>4.</td>
              <td>Fix and squish bugs</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                </div>
              </td>
              <td><span class="badge bg-green">90%</span></td>
            </tr>
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bordered Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Task</th>
              <th>Progress</th>
              <th style="width: 40px">Label</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
              </td>
              <td><span class="badge bg-red">55%</span></td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Clean database</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                </div>
              </td>
              <td><span class="badge bg-yellow">70%</span></td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Cron job running</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                </div>
              </td>
              <td><span class="badge bg-light-blue">30%</span></td>
            </tr>
            <tr>
              <td>4.</td>
              <td>Fix and squish bugs</td>
              <td>
                <div class="progress progress-xs progress-striped active">
                  <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                </div>
              </td>
              <td><span class="badge bg-green">90%</span></td>
            </tr>
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection