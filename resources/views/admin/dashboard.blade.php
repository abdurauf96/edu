@extends('layouts.admin')

@section('content')
<div class="row ">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">IT Markazlar</h5>
                  <h2 class="mb-3 font-18">{{ $schools->count() }}</h2>
{{--                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="/admin/assets/img/banner/1.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15"> Jami o'quvchilar</h5>
                  <h2 class="mb-3 font-18">{{ $number_students }}</h2>
{{--                  <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>--}}
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="/admin/assets/img/banner/2.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Statistika</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody><tr>
                            <th>T/R</th>
                            <th>IT Markaz</th>
                            <th>O'qiyatganlar</th>
                            <th>Bitirganlar</th>
                            <th>Jami</th>
                            <th>Action</th>
                        </tr>
                        @foreach($schools as $school)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $school->company_name }}</td>
                            <td>{{ $school->active_students_count }}</td>
                            <td>{{ $school->graduated_students_count }}</td>
                            <td>
                                {{ $school->students_count }}
                            </td>
                            <td><a href="{{ route('admin.schoolDetail', $school) }}" class="btn btn-primary">Batafsil</a></td>
                        </tr>
                        @endforeach
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
