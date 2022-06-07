@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url('/school/waiting-students') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/waiting-students/' . $waitingstudent->id . '/edit') }}" title="Edit WaitingStudent"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/waitingstudents', $waitingstudent->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete WaitingStudent',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $waitingstudent->id }}</td>
                            </tr>
                            <tr><th> Kurs </th><td> {{ $waitingstudent->course_id }} </td></tr>
                            <tr><th> F.I.O </th><td> {{ $waitingstudent->name }} </td></tr>
                            <tr><th> Telefon </th><td> {{ $waitingstudent->phone }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $waitingstudent->year }} </td></tr>
                            <tr><th> Manzil </th><td> {{ $waitingstudent->address }} </td></tr>
                            <tr><th> Passport </th><td> {{ $waitingstudent->passport }} </td></tr>
                            <tr><th> O'qish turi </th><td> {{ $waitingstudent->type==1 ? 'Oddiy': 'Grant' }} </td></tr>
                            <tr><th> Jinsi </th><td> {{ $waitingstudent->sex==1? 'Erkak' : 'Ayol' }} </td></tr>
                            <tr><th> Rasm </th><td><img src="/admin/images/waitingstudents/{{ $waitingstudent->image }}" width="200" >  </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
