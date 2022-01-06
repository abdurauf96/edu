@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>To'lovlar</h4> 
               
                
            </div>
            <div class="card-body">
                <div class="">
                    @foreach ($courses as $course)
                    <a href="?course_id={{ $course->id }}" class="btn {{ \Request::get('course_id')==$course->id? 'btn-primary' : 'btn-info' }} btn-sm" >
                        {{ $course->name }}
                    </a>    
                    @endforeach
                </div>
                <hr>
                <div>
                    @foreach ($months as $month)
                    <a href="?month_id={{ $month->id }}" class="btn btn-md {{ \Request::get('month_id')==$month->id? 'btn-primary' : 'btn-info' }} " >
                        {{ $month->name }}
                    </a>    
                    @endforeach
                </div>

                <div class="table-responsive table-hover " >
                    <table class="table table-bordered table-striped dataTable" id="table-1">
                    
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>O'quvchi</th>
                                <th>Guruh</th>
                                <th>O'qituvchi</th>
                                <th>To'lov miqdori</th>
                                <th>To'lov turi</th>
                                <th>To'lov oyi</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->student->group->name }}</td>
                                <td>{{ $item->student->group->teacher->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->month->name}} uchun</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('payments.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('payments.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
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