@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url('/school/staffs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/staffs/' . $staff->id . '/edit') }}" title="Edit Staff"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/staffs', $staff->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Staff',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $staff->id }}</td>
                            </tr>
                            <tr><th> F.I.O </th><td> {{ $staff->name }} </td></tr>
                            <tr><th> Lavozimi </th><td> {{ $staff->position }} </td></tr>
                            <tr><th> Telefon </th><td> {{ $staff->phone }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $staff->year }} </td></tr>
                            <tr><th> Passport malumotlari </th><td> {{ $staff->passport }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $staff->addres }} </td></tr>
                            <tr><th> Rasm </th><td> <img src="/admin/images/staffs/{{ $staff->image }}" width="100" alt="">  </td></tr>
                            <tr><th> QR code </th><td> <img src="/admin/images/qrcodes/{{ $staff->qrcode }}" width="200" alt=""> </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
