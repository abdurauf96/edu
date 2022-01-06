@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>Tahrirlash</h4> </div>
            <div class="card-body">
                <a href="{{ url('/school/waiting-students') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($waitingstudent, [
                    'method' => 'PATCH',
                    'url' => ['/school/waiting-students', $waitingstudent->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                @include ('school.waiting-students.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection