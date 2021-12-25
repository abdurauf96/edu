@extends('layouts.school')
@section('title')
    Kursni tahrirlash
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header"> <h4>Tahrirlash</h4> </div>
            <div class="card-body">
                <a href="{{ url('/school/courses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($course, [
                    'method' => 'PATCH',
                    'url' => ['/school/courses', $course->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                @include ('school.courses.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection