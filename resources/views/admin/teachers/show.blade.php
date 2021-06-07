@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

                <a href="{{ url('/admin/teachers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/admin/teachers/' . $teacher->id . '/edit') }}" title="Edit Teacher"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/teachers', $teacher->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Teacher',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $teacher->id }}</td>
                            </tr>
                            <tr><th> F.I.O </th><td> {{ $teacher->name }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $teacher->birthday }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $teacher->address }} </td></tr>
                            <tr><th> Telefon raqami </th><td> {{ $teacher->phone }} </td></tr>
                            <tr><th> Mutahasisligi </th><td> @foreach ($teacher->courses as $course)
                                {{ $course->name }}  @if(!$loop->last) , @endif
                            @endforeach</td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection