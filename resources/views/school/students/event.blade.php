@extends('layouts.reception')

@section('content')

<section class="content">

    <div class="row" id="app">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary">
          <div class="card-body card-profile">
            <img style="width:300px !important" class="profile-user-img img-responsive img-circle"  src="/admin/images/students/{{ $student->image }}" alt="User profile picture">

            <h3 class="profile-username text-center">{{ $student->name }}</h3>

            {{-- <p class="text-muted text-center">Software Engineer</p> --}}

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Guruhi</b> <a class="pull-right">{{ $student->group->name }}</a>
              </li>
              <li class="list-group-item">
                <b>Kurs</b> <a class="pull-right">{{ $student->group->course->name }}</a>
              </li>
              <li class="list-group-item">
                <b>Telefon</b> <a class="pull-right">{{ $student->phone }}</a>
              </li>
            </ul>
            @if($student->is_debt()) <a href="#" class="btn btn-danger btn-block"><b>Qarzi bor</b></a> @else <a href="#" class="btn btn-success btn-block"><b>Qarzi yo'q</b></a>  @endif

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">O'quvchi haqida</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-calendar margin-r-5"></i> Tug'ilgan yili</strong>

            <p class="text-muted">
              {{ $student->year }}
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Manzili</strong>

            <p class="text-muted">{{ $student->address }}</p>

            <hr>

            <strong><i class="fa fa-file-text-o margin-r-5"></i> Passport ma'lumotlari</strong>

            <p>{{ $student->passport }}</p>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box-header">
          <h3 class="box-title">O'quvchining kurslar uchun qilgan to'lovlari</h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>ID</th>
              <th>Kurs</th>
              <th>Guruh</th>

              <th>To'lov qilingan oylar</th>
              <th>To'lov summasi</th>
              <th>To'lov usuli</th>
              <th>To'lov sanasi</th>
            </tr>
            @foreach ($student->payments as $payment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->student->group->course->name }}</td>
                <td>{{ $payment->student->group->name }}</td>

                <td> {{ $payment->month->name }}</td>
                <td> {{ $payment->amount }}</td>
                <td> {{ $payment->type }}</td>
                <td> {{ $payment->created_at->format('d.m.Y') }}</td>

            </tr>
            @endforeach


          </tbody></table>
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>

@endsection
