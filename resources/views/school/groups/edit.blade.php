@extends('layouts.school')
@section('title', 'Tahrirlash')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> Tahrirlash </h4></div>
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

                {!! Form::model($group, [
                    'method' => 'PATCH',
                    'url' => ['/school/groups', $group->id],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}

                @include ('school.groups.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection