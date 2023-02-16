@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">To'lovlar statistikasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th >O'quvchilar soni</th>
                            <th>To'lov qilganlar</th>
                            <th>Qarzdorlar</th>
                            <th>Paynet orqali</th>
                            <th>Payme orqali</th>
                        </tr>

                        <tr>
                            <td>{{ $students->count() }}</td>
                            <td>{{ $students->count() - $students->toQuery()->where('debt', '>', 0)->count() }} </td>
                            <td>{{ $students->toQuery()->where('debt', '>', 0)->count() }}</td>
                            <td>
                                {{ $payments->toQuery()->where('type', 'paynet')->count() }}
                            </td>
                            <td>
                                {{ $payments->toQuery()->where('type', 'payme')->count() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">To'lovlar statistikasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Kurs nomi</th>
                    <th>Tushish kerak bo'lgan summa</th>
                    <th >Tushgan summa</th>
                    <th >Qolgan summa</th>
                    <th >Foiz ko'rsatkichi</th>
                    </tr>
                    @foreach ($statistika as $stat)
                        @continue($loop->first)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $stat['course_name'] }}</td>
                        <td>
                            {{ number_format($stat['fact_sum'], 0, '.', ',') }}
                        </td>
                        <td>{{ number_format($stat['real_sum'],0,'.', ',') }}</td>
                        <td>{{ number_format($stat['fact_sum']-$stat['real_sum'],0,'.', ',') }}</td>
                        <td> @if($stat['fact_sum']!=0) {{ number_format(round($stat['real_sum']/$stat['fact_sum']*100),0,'.', ',') }} @else 0 @endif % </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>#</td>
                        <td> <b> Jami</b></td>
                        <td> <b> {{ number_format($statistika['all']['fact_sum'],0,'.', ',') }}</b></td>
                        <td><b>{{ number_format($statistika['all']['real_sum'],0,'.', ',') }}</b></td>
                        <td><b>{{ number_format($statistika['all']['fact_sum']-$statistika['all']['real_sum'],0,'.', ',') }}</b></td>
                        <td><b>  {{  number_format(round($statistika['all']['real_sum']/$statistika['all']['fact_sum']*100 ),0,'.', ',') }} % </b></td>
                    </tr>

                </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection

