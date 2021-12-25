@extends('layouts.school')
@section('title')
    Kurs yaratish
@endsection
@section('content')
<div class="section-body">
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">Yangi qo'shish </div>
            <div class="card-body">
                <a href="{{ route('courses.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => route('courses.index'), 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('school.courses.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
</div>
@endsection