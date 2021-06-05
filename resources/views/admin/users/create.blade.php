@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
            <div class="box">
                <div class="box-header">Yangi yaratish</div>
                <div class="box-body">
                    <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal']) !!}

                    @include ('admin.users.form', ['formMode' => 'create'])

                    {!! Form::close() !!}

                </div>
            </div>
    </div>
</div>
@endsection
