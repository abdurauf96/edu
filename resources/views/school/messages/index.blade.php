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
                    <h4>Xabarnomalar</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped " id="table-1">

                            <thead>
                            <tr>
                                <th>#</th> <th>Student</th> <th>Xabar</th> <th>Sana</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->student->name }}</td>
                                    <td>{{ $item->body }}</td>
                                    <td>{{ $item->created_at->format('d-M-Y h:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    {{--    <!-- JS Libraies -->--}}
    {{--    <script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
    {{--    <script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>--}}
    {{--    <!-- Page Specific JS File -->--}}
    {{--    <script src="/admin/assets/js/page/datatables.js"></script>--}}
@endsection
