@extends('layouts.school')
@section('title', 'Guruh yaratish')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> Yangi qo'shish </h4> </div>
            <div class="card-body">
                <a href="{{ url('/school/groups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => '/school/groups', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('school.groups.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection