@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Edit Permission</div>
            <div class="box-body">
                <a href="{{ url('/school/permissions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($permission, [
                    'method' => 'PATCH',
                    'url' => ['/school/permissions', $permission->id],
                    'class' => 'form-horizontal'
                ]) !!}

                @include ('school.permissions.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection