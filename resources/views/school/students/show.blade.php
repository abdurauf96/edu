@extends('layouts.school')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/students/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
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
                            <tr><th> Guruh </th><td>
                                {{ $student->group->name ?? 'Guruhga bog\'lanmagan' }}
                            </td></tr>
                            <tr><th> Telefon </th><td> {{ $student->phone }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $student->district->name ?? '' }} | {{ $student->address }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $student->year }} </td></tr>
                            <tr><th> Passport ma`lumotlari </th><td> {{ $student->passport }} </td></tr>
                            <tr><th> Jinsi </th><td> {{ $student->sex==1 ? 'O\'g\'il' : 'Qiz'  }} </td></tr>
                            <tr><th> O'qish turi </th><td> {{ $student->type!=1 ? 'Grant '.$student->type : 'Oddiy'  }} </td></tr>
                            <tr><th>Qarzi </th> <td>   @if($student->is_debt())
                                        <div class="badge badge-danger">{{ number_format($student->debt) }}(qarzdor)</div>
                                    @else
                                        <div class="badge badge-success"> Qarzi yo'q </div>
                                    @endif</td>
                            </tr>
                            <tr><th> Rasmi </th><td> <img src="/admin/images/students/{{ $student->image }}" width="100" alt=""></td></tr>
                            <tr><th>Status </th>
                                <td> {{ $student->statusText() }}
                                </td>
                            </tr>
                            <tr><th>Dars boshlagan sanasi</th>  <td>{{ $student->start_date}}</td> </tr>
                            <tr><th>QR Code</th> <td><img src="/admin/images/qrcodes/{{ $student->qrcode }}" width="300" alt=""></td></tr>
                            <tr><th>Username</th> <td>{{ $student->username }}</td> </tr>
                            <tr><th>Kursni tamomlab ishga kirgan joyi</th> <td>{{ $student->future_work }}</td> </tr>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">O'quvchining kurslar uchun qilgan to'lovlari</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Kurs</th>
                  <th>Guruh</th>
                  <th>O'qituvchi</th>
{{--                  <th>To'lov qilingan oylar</th>--}}
                  <th>To'lov summasi</th>
                  <th>To'lov usuli</th>
                  <th>To'lov sanasi</th>
                </tr>
                @foreach ($student->payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->course->name ?? null }}</td>
                    <td>{{ $payment->student->group->name }}</td>
                    <td>{{ $payment->student->group->teacher->name }}</td>
{{--                    <td> {{ $payment->month->name }}</td>--}}
                    <td> {{ $payment->amount }}</td>
                    <td> {{ $payment->type }}</td>
                    <td> {{ $payment->created_at->format('d.m.Y') }}</td>

                </tr>
                @endforeach


              </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
