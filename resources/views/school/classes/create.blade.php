@extends('layouts.school')

@section('content')

        <div class="row">
           <div class="col-12">
                <div class="card">
                    <div class="card-header">Create New Class</div>
                    <div class="card-body">
                        <a href="{{ url('/school/classes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/school/classes') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('school.classes.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
