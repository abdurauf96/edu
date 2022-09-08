@extends('layouts.admin')

@section('content')
<div class="row ">
{{--    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
{{--      <div class="card">--}}
{{--        <div class="card-statistic-4">--}}
{{--          <div class="align-items-center justify-content-between">--}}
{{--            <div class="row ">--}}
{{--              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">--}}
{{--                <div class="card-content">--}}
{{--                  <h5 class="font-15">IT Markazlar</h5>--}}
{{--                  <h2 class="mb-3 font-18">{{ $schools->count() }}</h2>--}}
{{--                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">--}}
{{--                <div class="banner-img">--}}
{{--                  <img src="/admin/assets/img/banner/1.png" alt="">--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <div class="card-header">
                    <h4>Markazlar bo'yicha oq'uvchilar soni</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-md table-striped">
                        <tbody><tr>
                            <th>T/R</th>
                            <th>IT Markazlar</th>
                            <th>O'qiyatganlar</th>
                            <th>Bitirganlar</th>
                            <th>Chiqib ketganlar</th>
                            <th>Jami</th>
                        </tr>
                        @foreach($schools as $school)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $school->company_name }}</td>
                            <td>{{ $school->active_students_count }}</td>
                            <td>{{ $school->graduated_students_count }}</td>
                            <td>{{ $school->outed_students_count }}</td>
                            <td>
                                {{ $school->students_count }}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td><b>JAMI</b></td>
                            <td><b>{{ $schools->count() }}</b></td>
                            <td>{{ $students->active }}</td>
                            <td>{{ $students->graduated }}</td>
                            <td>{{ $students->outed }}</td>
                            <td>{{ $students->total }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-header">
                    <h4>Tumanlar bo'yicha markazlar soni</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-md">
                        <tbody><tr>
                            <th>T/R</th>
                            <th>Tumanlar</th>
                            <th>Markazlar soni</th>
                        </tr>
                        @foreach($districts as $district)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $district->name }}</td>
                                <td>{{ $district->schools_count }}</td>
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
