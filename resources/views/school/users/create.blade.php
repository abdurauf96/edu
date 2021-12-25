@extends('layouts.school')
@section('title')
    Foydalanuvchi yaratish
@endsection

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">Yangi yaratish</div>
                    <div class="card-body">
                        <a href="{{ url('/school/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/school/users', 'class' => 'form-horizontal']) !!}

                        @include ('school.users.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
