@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

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
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $course->id }}</td>
                            </tr>
                            <tr><th> Nomi </th><td> {{ $course->name }} </td></tr>
                            <tr><th> Davomiyligi </th><td> {{ $course->duration }} </td></tr>
                            <tr><th> Narxi </th><td> {{ $course->price }} </td></tr>
                            <tr><th> Maxsus kodi </th><td> {{ $course->code }} </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection