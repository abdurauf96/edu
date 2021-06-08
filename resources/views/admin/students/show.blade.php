@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

                <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/admin/students/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/students', $student->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Student',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $student->id }}</td>
                            </tr>
                            <tr><th> F.I.O </th><td> {{ $student->name }} </td></tr>
                            <tr><th> Guruh </th><td> @foreach ($student->groups as $group)
                                {{ $group->name }} @if(!$loop->last) , @endif 
                            @endforeach </td></tr>
                            <tr><th> Telefon </th><td> {{ $student->phone }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $student->address }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $student->year }} </td></tr>
                            <tr><th> Passport ma`lumotlari </th><td> {{ $student->passport }} </td></tr>
                            <tr><th> Code</th><td> {{ $student->code }} </td></tr>
                            <tr><th> Rasmi </th><td> <img src="/admin/images/students/{{ $student->image }}" width="100" alt=""></td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection