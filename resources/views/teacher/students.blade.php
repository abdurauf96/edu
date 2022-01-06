@extends('layouts.teacher')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> <h4> O'quvchilar</h4>
                 
                </div>
                <div class="card-body">

                    <div class="table-responsive dataTables_wrapper " >
                        <table class="table table-bordered table-striped dataTable" id="table-1">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Guruh</th>

                                <th>Telefon</th>
                                <th>Manzil</th>

                                <th>Rasm</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->guard('teacher')->user()->students as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> {{ $item->group->name }} </td>

                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td>

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