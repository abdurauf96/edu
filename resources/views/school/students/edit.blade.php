@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Tahrirlash</h4> </div>
            <div class="card-body">
                <a href="{{ url('/school/students') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Kerakli maydonlarni to'ldiring !</p>
                    </div>
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
