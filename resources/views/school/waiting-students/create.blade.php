@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4> Yangi qo'shish </h4></div>
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

                {!! Form::open(['url' => '/school/waiting-students', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('school.waiting-students.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){

            $('.select2').select2({
                placeholder: "Tanlang...",
                allowClear: true,
                required: true
            });
        });
    </script>
@endsection
