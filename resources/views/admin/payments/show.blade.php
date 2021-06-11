@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

                <a href="{{ url('/admin/payments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/admin/payments/' . $payment->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/payments', $payment->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Payment',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $payment->id }}</td>
                            </tr>
                            <tr><th> O'quvchi </th><td> {{ $payment->student->name }} </td></tr>
                            <tr><th> Kurs</th><td> {{ $payment->course->name }} </td></tr>
                            <tr><th> Guruh </th><td> {{ $payment->group->name }} </td></tr>
                            <tr><th> O'qituvchi </th><td> {{ $payment->group->teacher->name }} </td></tr>
                            <tr><th> To'lov miqdori </th><td> {{ $payment->amount }} </td></tr>
                            <tr><th> To'lov turi </th><td> {{ $payment->type }} </td></tr>
                            <tr><th> To'lov oyi </th><td> {{ $payment->month }} uchun </td></tr>
                            <tr><th> To'lov haqida </th><td> {{ $payment->description }} </td></tr>
                            <tr><th> To'lov qilingan vaqt </th><td> {{ $payment->created_at }} </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection