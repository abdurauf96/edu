@extends('layouts.school')
@section('title')
    {{ $course->name }}
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url('/school/courses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/courses/' . $course->id . '/edit') }}" title="Edit Course"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['school/courses', $course->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Course',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $course->id }}</td>
                            </tr>
                            <tr><th> Nomi </th><td> {{ $course->name }} </td></tr>
                            <tr><th> Davomiyligi </th><td> {{ $course->duration }} </td></tr>
                            <tr><th> Narxi </th><td> {{ $course->price }} </td></tr>
                            <tr><th> Narxi (yozuv bilan) </th><td> {{ $course->price_as_text }} </td></tr>
                            <tr><th> Maxsus kodi </th><td> {{ $course->code }} </td></tr>
                            <tr><th> Kurs ta'rifi  </th><td> {{ $course->description }} </td></tr>
                            <tr><th> Kurs haqida  </th><td> {!! $course->body !!} </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
