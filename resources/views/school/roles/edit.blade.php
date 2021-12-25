@extends('layouts.school')
@section('title')
    Tahrirlash
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">Tahrirlash</div>
            <div class="card-body">
                <a href="{{ url('/school/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($role, [
                    'method' => 'PATCH',
                    'url' => ['/school/roles', $role->id],
                    'class' => 'form-horizontal'
                ]) !!}

                @include ('school.roles.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>  
    </div>
</div>
@endsection
