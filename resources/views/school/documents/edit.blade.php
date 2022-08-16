@extends('layouts.school')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Tahrirlash #{{ $document->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/school/documents') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/school/documents/' . $document->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('school.documents.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
