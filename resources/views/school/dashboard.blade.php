@extends('layouts.school')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-purple">
        <i class="fas fa-cart-plus"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i> {{ $students['count_active'] }} / {{ $students['count_test_active'] }}
            </h3><a href="{{ route('students.index') }}"><span class="text-muted"> O'quvchilar soni </span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-green">
        <i class="fas fa-hiking"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i> {{ $count_good_attandance }}
            </h3>
              <a href="{{ route('students.index', ['status'=>'good-attandance']) }}"><span class="text-muted">Faol o'quvchilar soni</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-cyan">
        <i class="fas fa-chart-line"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i> {{ $count_bad_attandance }}
            </h3>
              <a href="{{ route('students.index', ['status'=>'bad-attandance']) }}"><span class="text-muted">Nofaol o'quvchilar soni</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-orange">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i>{{ $left_this_month }}
            </h3>
              <a href="{{ route('students.index', ['status'=>'left-recently']) }}"><span class="text-muted">Ushbu oyda chiqib ketganlar</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-orange">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i> {{ $students['count_graduated'] }}
            </h3>
              <a href="{{ route('students.index', ['status'=>'graduated']) }}"> <span class="text-muted">Bitiruvchilar soni</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-purple">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i>{{ $students['count_discount'] }}
            </h3>
              <a href="{{ route('students.index', ['payment'=>'discount']) }}"><span class="text-muted">Chegirmalar</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-cyan">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i>{{ $students['count_girls'] }}
            </h3>
              <a href="{{ route('students.index', ['gender'=>'girls']) }}"><span class="text-muted">Qizlar soni</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon l-bg-green">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="padding-20">
          <div class="text-right">
            <h3 class="font-light mb-0">
              <i class="ti-arrow-up text-success"></i>{{ $students['count_boys'] }}
            </h3>
              <a href="{{ route('students.index', ['gender'=>'boys']) }}"><span class="text-muted">O'g'il bolalar soni</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
