@extends('layouts.school')

@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('title', 'Guruhlar')
    
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> 
                <h4>Guruhlar</h4>
                <div class="card-header-form">
                    <a href="{{ route('groups.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                </div>
               
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="table-1">
                    
                        <thead>
                            <tr>
                                <th>#</th><th>Nomi</th><th>O'qituvchi</th><th>Kurs</th> <th>Status</th><th>O'quvchilar soni</th>  <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td><td>{{ $item->teacher->name }}</td>
                                <td>{{ $item->course->name }}</td>
                                
                                <td>{{ $item->status==1 ? 'Guruh to`lgan' : 'Guruh to\'lmoqda' }}</td>
                                <td>{{ count($item->students) }} ta</td>
                                <td>
                                    <a href="{{ route('groups.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('groups.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    
                                    
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/groups', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Group',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ url('/school/groups/' . $item->id . '/add-student') }}" title="Add Student"><button class="btn btn-primary btn-md"><i class="fa fa-user-plus" aria-hidden="true"></i></button></a>
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