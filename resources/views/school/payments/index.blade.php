@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>To'lovlar </h4>
                {{-- <div class="card-header-form">
                    <a href="{{ route('payments.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                </div> --}}
            </div>
            <div class="card-body">

                <div class="table-responsive dataTables_wrapper " >
                    <table class="table table-bordered table-striped table-hover " id="table-1">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>To'lovchi</th>
                                <th>Miqdor</th>
                                <th>Turi</th>
                                <th>Maqsadi</th>
                                <th>Ma'lumot</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    @switch($item->purpose)
                                        @case(1)
                                            O'quv kursi
                                            @break
                                        @case(2)
                                            Kibersport
                                            @break
                                        @case(3)
                                            Coworking
                                            @break
                                        @case(4)
                                            Konferens zal
                                            @break
                                        @default
                                            Boshqa
                                    @endswitch
                                </td>

                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('payments.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
{{--                                    <a href="{{ route('payments.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>--}}
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/payments', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger ',
                                                'title' => 'Delete Payment',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
<script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
