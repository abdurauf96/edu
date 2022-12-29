@extends('layouts.school')
@section('title', 'Tahrirlash')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Tahrirlash </div>
            <div class="card-body">
                <a href="{{ url('/school/teachers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                {!! Form::model($teacher, [
                    'method' => 'PATCH',
                    'url' => ['/school/teachers', $teacher->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                @include ('school.teachers.form', ['formMode' => 'edit'])
                {!! Form::close() !!}
               
            </div>
        </div>
    </div>
</div>
@endsection