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
                <h4>Bugungi darslar</h4> 
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="table-1">
                    
                        <thead>
                            <tr>
                                <th>#</th><th>Guruh</th><th>O'qituvchi</th><th>Kurs</th> <th>Xona</th> <th>Dars vaqti</th> <th>O'quvchilar soni</th>  <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td><td>{{ $item->teacher->name }}</td>
                                <td>{{ $item->course->name }}</td>
                                
                                <td> <span class="badge badge-primary">{{ $item->room_number  }} </span></td>
                                <td> <span class="badge badge-primary">{{ date("H:i", strtotime($item->time))   }} </span></td>
                                <td>{{ $item->students_count }} ta</td>
                                <td>
                                    <a href="{{ route('groups.show', $item->id) }}" class="btn btn-icon btn-success">Batafsil</a>
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