@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/appeals/' . $appeal->id . '/edit') }}" title="Edit appeal"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/appeals', $appeal->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete appeal',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $appeal->id }}</td>
                            </tr>
                            <tr><th> F.I.O </th><td> {{ $appeal->name }} </td></tr>
                            <tr><th> Manzil </th><td>
                                {{ $appeal->address }}
                            </td></tr>
                            <tr><th> Telefon </th><td> {{ $appeal->phone }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $appeal->address }} </td></tr>
                            <tr><th> O'qish/Ish joyi </th><td> {{ $appeal->study_type }} </td></tr>
                            <tr><th> Tanlagan dars vaqti </th><td> 
                                @switch($appeal->lesson_time)
                                    @case(1)
                                    Ertalab 08:00 - 13:00
                                        @break
                                    @case(2)
                                    Abetdan keyin 13:00 - 17:00
                                        @break
                                    @case(3)
                                        Kunning kechgi qismida 17:00 - 20:00
                                        @break
                                    @default
                                        Boshqa
                                @endswitch </td>
                            </tr>
                            <tr><th> Kompyuter bilan ishlash darajasi </th><td> 
                                @switch($appeal->comp_level)
                                    @case(1)
                                    Umuman bilmaydi 
                                        @break
                                    @case(2)
                                    O'rtacha 
                                        @break
                                    @case(3)
                                    Yaxshi 
                                        @break
                                    @default
                                        Boshqa
                                @endswitch </td>
                            </tr>
                            <tr><th> Dasturlash tushunchasi </th><td> 
                                @switch($appeal->prog_level)
                                    @case(1)
                                    Umuman tushunchaga ega emas
                                        @break
                                    @case(2)
                                    Ozroq xabari bor
                                        @break
                                    @case(3)
                                    Kod yozoladi
                                        @break
                                    @default
                                        Boshqa
                                @endswitch </td>
                            </tr>
                            <tr><th> Shaxsiy kompyuteri borligi </th><td> 
                                @switch($appeal->has_comp)
                                    @case(0)
                                    Yoq
                                        @break
                                    @case(1)
                                   Bor
                                        @break
                                    
                                    @default
                                        Boshqa
                                @endswitch </td>
                            </tr>
                            <tr><th> Tanlagan yo'nalishi </th><td> 
                                @switch($appeal->direction)
                                    @case(1)
                                    Dasturlash
                                        @break
                                    @case(2)
                                    Dizayn
                                        @break
                                @endswitch </td>
                            </tr>
                            <tr><th> Ro'yhatga olingan sana </th><td> {{ $appeal->created_at->format('d-m-Y') }} </td></tr>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
     
    </div>
</div>
@endsection
