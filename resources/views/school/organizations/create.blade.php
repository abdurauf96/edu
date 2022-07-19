@extends('layouts.school')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Yangi qo'shish</div>
                <div class="card-body">
                    <a href="{{ url('/school/organizations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/school/organizations') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('school.organizations.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
