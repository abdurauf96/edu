@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Tahrirlash </div>
            <div class="box-body">
                <a href="{{ url('/school/students') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($student, [
                    'method' => 'PATCH',
                    'url' => ['/school/students', $student->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                @include ('school.students.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection