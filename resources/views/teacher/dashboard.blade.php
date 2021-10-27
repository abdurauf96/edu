@extends('layouts.teacher')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">O'quvchilar</span>
                    <span class="info-box-number">{{ count(auth()->guard('teacher')->user()->students) }}<small>ta</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Guruhlar</span>
                    <span class="info-box-number">{{ count(auth()->guard('teacher')->user()->groups) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

{{--        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--            <div class="info-box">--}}
{{--                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>--}}

{{--                <div class="info-box-content">--}}
{{--                    <span class="info-box-text">Sales</span>--}}
{{--                    <span class="info-box-number">760</span>--}}
{{--                </div>--}}
{{--                <!-- /.info-box-content -->--}}
{{--            </div>--}}
{{--            <!-- /.info-box -->--}}
{{--        </div>--}}
{{--        <!-- /.col -->--}}
{{--        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--            <div class="info-box">--}}
{{--                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>--}}

{{--                <div class="info-box-content">--}}
{{--                    <span class="info-box-text">New Members</span>--}}
{{--                    <span class="info-box-number">2,000</span>--}}
{{--                </div>--}}
{{--                <!-- /.info-box-content -->--}}
{{--            </div>--}}
{{--            <!-- /.info-box -->--}}
{{--        </div>--}}
        <!-- /.col -->
    </div>
@endsection
